<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\TradeMark;

class TradeMarkController extends Controller
{

    public function listofTradeMarks(){

        $trade_marks = TradeMark::all();

        return response()->json([
            'trade_marks' => $trade_marks
        ], 200);
    }
}
