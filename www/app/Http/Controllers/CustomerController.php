<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\UgraiBook;
use App\CashBook;

class CustomerController extends Controller
{
    public function getAJAXCustomers($customerName){
        $customers = Customer::where('name', 'LIKE', '%' . $customerName . '%')->get();
        return response()->json([
            'customers' => $customers
        ], 200);
    }
    public function getAJAXCustomer($phone_no){
        $customer = Customer::where('phone_no', 'LIKE', '%' .$phone_no)->first();
        return response()->json([
            'customer' => $customer
        ], 200);
    }
    //
    /**
     * simeple crud
     */
    public function index(){
        $customers = Customer::all();
        return view('customer.index')->with([
            'customers' => $customers
        ]);
    }
    public function edit($id){
        $customer = Customer::find($id);
        return view('customer.edit')->with([
            'customer' => $customer
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'phone_no' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'description' => 'string|nullable',
            'new_paid_ammount' => 'nullable|numeric'
        ]);

        $customer = Customer::find($request->customerId);
        $customer->name = $request->name;
        $customer->phone_no = $request->phone_no;
        if($request->new_paid_ammount){
            $customer->total_dues = $customer->total_dues - $request->new_paid_ammount;
        }
        
        $customer->description = $request->description ? $request->description : '';
        $customer->save();
        
        if($request->new_paid_ammount){
            $ugrai = new UgraiBook;
            $ugrai->customer_id = $customer->id;
            $ugrai->new_paid_ammount = $request->new_paid_ammount;
            $ugrai->total_dues = $customer->total_dues;
            $ugrai->save();

            $cashBook = new CashBook;
            $cashBook->transaction_type = 'credited';
            $cashBook->total_ammount = $request->new_paid_ammount;
            $cashBook->description = $request->new_paid_ammount . "/- Rupees credited to Cash book. [Dues received from Customer]";
            $cashBook->save();
        }
        

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Ugrai book record updated...'
        ]);
    }
}
