<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempBook;
use App\Customer;
use App\CashBook;
use App\TradeMark;
use App\FoodType;
use App\Cart;
use App\BikriBook;
use Auth;

class TempBookController extends Controller
{
    public function index(){
        $tempBooks = TempBook::orderBy('created_at', 'DESC')->get();
        return view('tempBook.index')->with([
            'tempBooks' => $tempBooks
        ]);
    }

    public function create(){
        return view('tempBook.create');
    }

    public function edit($id){
        $tempBook = TempBook::find($id);
        $tradeMarks = TradeMark::all();
        $cartItems = Cart::where('temp_book_id', $tempBook->id)->get();
        
        return view('tempBook.edit')->with([
            'tempBook' => $tempBook,
            'tradeMarks' => $tradeMarks,
            'cartItems' => $cartItems
        ]);
    }

    public function delete($id){
        try {
            TempBook::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Tempbook cannot be deleted.'
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Temp book record deleted successfully'
        ]);
    }

    public function submit(Request $request){
        // dd($request);
        $request->validate([
            'customer_name' => 'required|string|min:3|max:15',
            'phone_no' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'description' => 'nullable|string',
        ]);

        $customer = Customer::where('phone_no', $request->phone_no)->first();
        if(is_null($customer)){
            $customer = new Customer;
            $customer->name = $request->customer_name;
            $customer->phone_no = $request->phone_no;
            $customer->description = $request->description ? $request->description : '';
            $customer->save();
        }
        $tempBook = new TempBook;
        $tempBook->user_id = Auth::user()->id;
        $tempBook->customer_id = $customer->id;
        $tempBook->save();
        
        return redirect('/tempBook/edit/'.$tempBook->id)->with([
            'success' => true,
            'message' => 'Customer record added...',
            // 'print' => true
        ]);
    }
    public function update(Request $request){
        // dd($request);
        try {
            $tempBook = TempBook::findOrFail($request->tempBookId);
            $tempBook->paid_ammount = $request->paid_ammount;
            $tempBook->total_price = $request->totalAmmount;
            $tempBook->due_ammount = $request->totalAmmount - $request->paid_ammount;
            $tempBook->save();

            $customer = Customer::findOrFail($tempBook->Customer->id);
            $customer->total_dues += $tempBook->due_ammount;
            $customer->save();

            $cashBook = new CashBook;
            $cashBook->transaction_type = 'credited';
            $cashBook->total_ammount = $request->paid_ammount;
            $cashBook->description = $request->paid_ammount . "/- Rupees credited to Cash book. [Cash received from Customer]";
            $cashBook->save();

            $cartItems = Cart::where('temp_book_id', $tempBook->id)->get();
            foreach($cartItems as $cartItem){
                $provider = $cartItem->FoodType->TradeMark->Provider;
                $bikriCol = BikriBook::where('provider_id', $provider->id)->where('is_paid', 0)->first();
                if(is_null($bikriCol)){
                    $bikri = new BikriBook;
                    $bikri->provider_id = $provider->id;
                    $bikri->kham_bikri += $cartItem->sub_total;
                    $bikri->save();
                }else{
                    $bikriCol->kham_bikri += $cartItem->sub_total;
                    $bikriCol->save();
                }
            }

            //code...
        } catch (\Throwable $th) {
            throw $th;
            return redirect('/tempBook/edit/'.$request->tempBookId)->with([
                'error' => true,
                'message' => 'Server side error 500'
            ]);
        }

        return redirect('/tempBook/edit/'.$request->tempBookId)->with([
            'success' => true,
            'message' => 'Temp Book Recorded Successfully'
        ]);
    }

    public function updateCartItem(Request $request){
        try {
            $tempBook = TempBook::findOrFail($request->tempBookId);
            $foodType = FoodType::findOrFail($request->food_type_id);
            // dd([$request, $tempBook]);
            $cartItem = Cart::where('temp_book_id', $tempBook->id)->where('food_type_id', $request->food_type_id)->first();
            if(is_null($cartItem)){
                $cartItem = new Cart;
                $cartItem->temp_book_id = $tempBook->id;
                $cartItem->food_type_id = $request->food_type_id;
                $cartItem->quantity = $request->quantity;
                $cartItem->sub_total = $request->quantity * $foodType->price_per_crate;
                $cartItem->save();
            }else{
                $cartItem->temp_book_id = $tempBook->id;
                $cartItem->food_type_id = $request->food_type_id;
                $cartItem->quantity += $request->quantity;
                $cartItem->sub_total += $request->quantity * $foodType->price_per_crate;
                $cartItem->save();
            }

            $foodType->remaining_quantity -= $request->quantity;
            $foodType->save();            


        } catch (\Throwable $th) {
            dd($th);
            // throw $th;
            return redirect('/tempBook/edit/'.$request->tempBookId)->with([
                'error' => true,
                'message' => 'Item cannot added to your cart list, due to some server side error...'
            ]);
        }

        return redirect('/tempBook/edit/'.$request->tempBookId)->with([
            'success' => true,
            'message' => 'Item Added to your cart list...'
        ]);
    }
    public function deleteCartItem($id, $tempBookId){
        Cart::destroy($id);

        return redirect('/tempBook/edit/'.$tempBookId)->with([
            'success' => true,
            'message' => 'Item removed from your cart list...'
        ]);
    }

    //
}
