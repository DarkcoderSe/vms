<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CashBook;

class CashFlowController extends Controller
{
    public function index(){
        $cashCols = CashBook::orderBy('created_at', 'DESC')->get();
        return view('cashBook.index')->with([
            'cashCols' => $cashCols
        ]);
    }
    //
//     public function delete($id){
//         CashBook::destroy($id);

//         return redirect()->back()->with([
//             'success' => true,
//             'message' => 'Provider record deleted successfully'
//         ]);
//     }
}
