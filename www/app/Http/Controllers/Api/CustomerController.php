<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\UgraiBook;
use App\CashBook;

class CustomerController extends Controller {


        public function customerswithDues(){
        $customers = Customer::where('total_dues', '>', 0)->get();

        return response()->json([
            'customers' => $customers
        ], 200);
    }

    public function updatePaidAmmount(Request $request){
        try{
            $customers = Customer::find($request->id);
            $customers->total_dues = $customers->total_dues - $request->new_paid_ammount;
            $customers->new_paid_ammount = $request->new_paid_ammount;
            $customers->save();

            if($request->new_paid_ammount){
                $ugrai = new UgraiBook;
                $ugrai->customer_id = $customers->id;
                $ugrai->new_paid_ammount = $request->new_paid_ammount;
                $ugrai->total_dues = $customers->total_dues;
                $ugrai->save();
            }

        }catch(\Throwable $th){
            return response()->json([
                'message' => 'error occured'
            ], 500);
        }

        return response()->json([
            'message' => 'customer total dues and new paid ammount updated'
        ], 200);
    }
}

//namespace App\Http\Controllers\Api;
//
//
//use App\CashBook;
//use App\Customer;
//use App\Http\Controllers\Controller;
//use App\UgraiBook;
//use Illuminate\Http\Request;
//
//class CustomerController extends Controller
//{
//
//    public function listOfCustomers(){
//        $customers = Customer::all();
//
//        return response()->json([
//            'customers' => $customers
//        ], 200);
//    }
//
//    public function customerswithDues(){
//        $customers = Customer::where('total_dues', '>', 0)->get();
//
//        return response()->json([
//            'customers' => $customers
//        ], 200);
//    }
//
//    public function edit($customerId){
//        $customer = Customer::find($customerId);
//
//        return response()->json([
//            'customer' => $customer
//        ], 200);
//    }
//
//
//    public function updatebyid(Request $request, $id){
//
//
//        $customer = Customer::find($id);
//        $customer->name = $request->name;
//        $customer->phone_no = $request->phone_no;
//        $customer->description = $request->description;
//        if($request->new_paid_ammount){
//            $customer->total_dues = $customer->total_dues - $request->new_paid_ammount;
//        }
//        $customer->save();
//
//    }
//
//
//    public function update(Request $request){
//        try {
//            $customer = Customer::find($request->id);
//            $customer->name = $request->name;
//            $customer->phone_no = $request->phone_no;
//            if($request->new_paid_ammount){
//                $customer->total_dues = $customer->total_dues - $request->new_paid_ammount;
//            }
//
//            $customer->description = $request->description ? $request->description : '';
//            $customer->save();
//
////            if($request->new_paid_ammount){
////                $ugrai = new UgraiBook;
////                $ugrai->customer_id = $customer->id;
////                $ugrai->new_paid_ammount = $request->new_paid_ammount;
////                $ugrai->total_dues = $customer->total_dues;
////                $ugrai->save();
////
////                $cashBook = new CashBook;
////                $cashBook->transaction_type = 'credited';
////                $cashBook->total_ammount = $request->new_paid_ammount;
////                $cashBook->description = $request->new_paid_ammount . "/- Rupees credited to Cash book. [Dues received from Customer{API}]";
////                $cashBook->save();
////            }
//
//        } catch (\Throwable $th) {
//            //throw $th;
//            return response()->json([
//                'message' => 'error occured'
//            ], 500);
//        }
//
//        return response()->json([
//            'message' => 'customer,ugrai and cash book detail updated'
//        ], 200);
//    }
//
//}
