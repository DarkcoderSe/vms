<?php

namespace App\Http\Controllers;

use App\OwnerTransaction;
use Illuminate\Http\Request;
use App\Owners;

class OwnerController extends Controller
{
    public function index(){
        $owners = Owners::all();
        return view('owner.index')->with([
            'owners' => $owners
        ]);
    }
    public function create(){
        return view('owner.create');
    }
    public function edit($id){
        $owner = Owners::find($id);
        return view('owner.edit')->with([
            'owner' => $owner
        ]);
    }
    public function submit(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'phone_no' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'share' => 'required|numeric',
            'net_worth' => 'nullable|numeric',
            'address' => 'nullable|string'
        ]);
        $owner = new Owners;
        $owner->name = $request->name;
        $owner->phone_no = $request->phone_no;
        $owner->share = $request->share;
        $owner->address = $request->address;
        $owner->net_worth = $request->net_worth;
        
        $owner->save();

        return redirect('/owner')->with([
            'success' => true,
            'message' => 'Owner record added successfully'
        ]);

    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'phone_no' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'share' => 'required|numeric',
            'net_worth' => 'nullable|numeric',
            'address' => 'nullable|string'
        ]);
        $owner = Owners::find($request->id);
        $owner->name = $request->name;
        $owner->phone_no = $request->phone_no;
        $owner->share = $request->share;
        $owner->address = $request->address;
        $owner->net_worth = $request->net_worth;
        
        $owner->save();

        return redirect('/owner')->with([
            'success' => true,
            'message' => 'Owner record updated successfully'
        ]);
    }
    //
    public function transaction_page($id){
//        dd($id);
        $owner = Owners::where('id', $id)->first();

        return view("owner.updateTranscation",[
            "owner" => $owner,
        ]);
    }

    public function calculate_transactions(Request $request){
//        dd($request->all());
        $data = $request->all();
        // $oldnetworth = (int)$data["net_worth"];
        $networth = (int)$data["net_worth"] - (int)$data["expenses"];

        OwnerTransaction::create([
           "owner_id" => $data["id"],
            "expenses" => $data["expenses"],
            "description" => $data["description"],
        ]);

        $owner = Owners::where("id", $data["id"])->first();
        $owner->net_worth = (string)$networth;
        $owner->save();

        return redirect()->back();
    }
    public function indexTransactions(){
//        dd($id);
        $transactionHistorys = OwnerTransaction::orderBy('created_at', 'DESC')->get();
        return view('owner.transcationHistory')->with([
            'transactionHistorys' => $transactionHistorys
        ]);
    }
    // public function delete($id){
    //      Owners::destroy($id);
    //     return redirect()->back()->with([
    //         'success' => true,
    //         'message' => 'Provider record deleted successfully'
    //     ]);
    // }
}

