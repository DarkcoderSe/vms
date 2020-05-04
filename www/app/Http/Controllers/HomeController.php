<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CashBook;
use DB;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $creditedCash = DB::table('cash_books')->where('transaction_type', '=', 'credited')->sum('total_ammount');
        $debitedCash = DB::table('cash_books')->where('transaction_type', '=', 'debited')->sum('total_ammount');
        $cratesSold = DB::table('carts')->sum('quantity');
        $totalDues = DB::table('customers')->sum('total_dues');

        $totalCustomers = Customer::count();

        $totalCash = $creditedCash - $debitedCash;
        return view('home')->with([
            'totalCash' => $totalCash,
            'cratesSold' => $cratesSold,
            'totalCustomers' => $totalCustomers,
            'totalDues' => $totalDues
        ]);
    }
}
