<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodType;

class FoodTypeController extends Controller
{
    public function create($id){
        return view('provider.foodType.create')->with([
            'tradeMarkId' => $id 
        ]);
    }
    public function edit($id){
        $foodType = FoodType::find($id);
        return view('provider.foodType.edit')->with([
            'foodType' => $foodType
        ]);
    }
    public function delete($id){
        FoodType::destroy($id);
        return redirect()->back()->with([
            'success' => true,
            'message' => 'Food Type Added successfully'
        ]);
    }

    public function submit(Request $request){
        $request->validate([
            'serial_no' => 'required|string',
            'price_per_crate' => 'required|integer',
            'total_quantity' => 'required|integer',
            'remaining_quantity' => 'required|integer'
        ]);

        $foodType = new FoodType;
        $foodType->trade_mark_id = $request->trade_mark_id;
        $foodType->serial_no = $request->serial_no;
        $foodType->price_per_crate = $request->price_per_crate;
        $foodType->total_quantity = $request->total_quantity;
        $foodType->remaining_quantity = $request->remaining_quantity;
        $foodType->save();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Food Type Added successfully'
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'serial_no' => 'required|string',
            'price_per_crate' => 'required|integer',
            'total_quantity' => 'required|integer',
            'remaining_quantity' => 'required|integer'
        ]);

        $foodType = FoodType::find($request->foodTypeId);
        $foodType->serial_no = $request->serial_no;
        $foodType->price_per_crate = $request->price_per_crate;
        $foodType->total_quantity = $request->total_quantity;
        $foodType->remaining_quantity = $request->remaining_quantity;
        $foodType->save();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Food Type updated successfully'
        ]);
    }
    //
    public function getAJAXFoodTypes($tradeMarkId){
        $foodTypes = FoodType::where('trade_mark_id', $tradeMarkId)->get();
        return response()->json([
            'foodTypes' => $foodTypes
        ], 200);
    }
    public function getAJAXFoodType($foodTypeId){
        $foodType = FoodType::find($foodTypeId);
        return response()->json([
            'foodType' => $foodType
        ], 200);
    }
}
