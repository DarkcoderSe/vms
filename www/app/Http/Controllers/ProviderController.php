<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\TradeMark;
use App\Truck;

class ProviderController extends Controller
{
    public function index(){
    
        $providers = Provider::paginate(10);
        return view('provider.index')->with([
            'providers' => $providers
        ]);
    }

    public function create(){
        return view('provider.create');
    }

    public function edit($id){
        $provider = Provider::find($id);
        $tradeMark = TradeMark::where('provider_id', $provider->id)->first();
        if(!is_null($tradeMark)){
            $trucks = Truck::where('trade_mark_id', $tradeMark->id)->get();
        }else{
            $trucks = Truck::where('trade_mark_id', 0)->get();
        }
        // dd($provider);
        return view('provider.edit')->with([
            'provider' => $provider,
            'tradeMark' => $tradeMark,
            'trucks' => $trucks
        ]);
    }

    public function delete($id){
        Provider::destroy($id);

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Provider record deleted successfully'
        ]);
    }

    public function submit(Request $request){
        // dd($request);

        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'phone_no' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'string|nullable',
        ]);
        try {
            $provider = new Provider;
            $provider->name = $request->name;
            $provider->phone_no = $request->phone_no;
            $provider->address = $request->address;
            $provider->save();

        } catch(\Throwable $th){
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Error 500: Server side error'
            ]);   
        }
        return redirect()->route('providerEdit',"$provider->id")->with([
            'success' => true,
            'message' => 'Provider record submitted successfully'
        ]);
    }
    public function update(Request $request){
        
        try {

            $provider = Provider::findOrFail($request->id);
            $provider->name = $request->name;
            $provider->phone_no = $request->phone_no;
            $provider->address = $request->address;
            $provider->save();

        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Error 500: Server side error'
            ]);  
        }
        return redirect('provider/edit/'.$provider->id)->with([
            'success' => true,
            'message' => 'Provider record updated successfully'
        ]);
    }
    //
    /**
     * Traede mark crud
     */
    public function tradeMarkUpdate(Request $request){
        $request->validate([
            'marka_name' => 'required|string',
            'quantity' => 'required|integer',
            'description' => 'nullable'
        ]);

        try {
            $oldTradeMark = TradeMark::where('provider_id', $request->provider_id)->first();
            if(is_null($oldTradeMark)){
            $tradeMark = new TradeMark;
            $tradeMark->provider_id = $request->provider_id;
            $tradeMark->marka_name = $request->marka_name;
            $tradeMark->quantity = $request->quantity;
            $tradeMark->description = $request->description;
            $tradeMark->save(); 
            }else{
                $oldTradeMark->marka_name = $request->marka_name; 
                $oldTradeMark->quantity = $request->quantity;
                $oldTradeMark->description = $request->description;
                $oldTradeMark->save();
            }
            
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Error 500: Server side error'
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => 'trade mark record updated successfully'
        ]);
    }

    /**
     * Truck CRud
     */
    
    public function truckSubmit(Request $request){
        $truck = new Truck;
        $truck->truck_number = $request->truck_number;
        $truck->trade_mark_id = $request->trade_mark_id;
        $truck->save();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'truck added successfully'
        ]);
    }
    public function truckDelete($id){
        Truck::destroy($id);

        return redirect()->back()->with([
            'success' => true,
            'message' => 'truck deleted successfully'
        ]);        
    }
  
}
