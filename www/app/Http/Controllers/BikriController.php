<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BikriBook;
use App\Provider;
use App\CashBook;
use App\Owners;

class BikriController extends Controller
{
    public function index($providerId){
        $provider = Provider::find($providerId);
        $bikriRecord = BikriBook::where('provider_id', $providerId)->where('is_paid', 0)->first();
        $bikriRecords = BikriBook::where('provider_id', $providerId)->get();
        
        return view('provider.bikri.index')->with([
            'bikriRecord' => $bikriRecord,
            'provider' => $provider,
            'bikriRecords' => $bikriRecords
        ]);
    }

    public function submit(Request $request){
        $request->validate([
            'minhai' => 'nullable|numeric',
            'mazdori' => 'nullable|numeric',
            'karaya' => 'nullable|numeric',
            'daak' => 'nullable|numeric',
            'store' => 'nullable|numeric',

        ]);

        $bikri = BikriBook::find($request->id);
        $total = $bikri->kham_bikri;
        $bikri->comission = $request->comission;
        $total = $total - (($total/100)*$bikri->comission);
        $bikri->minhai = $request->minhai;
        $bikri->mazdori = $request->mazdori;
        $bikri->karaya = $request->karaya;
        $bikri->daak = $request->daak;
        $bikri->store = $request->store;

        $comissionCash = ($bikri->kham_bikri/100)*$bikri->comission;

        $total -= $bikri->minhai;
        $total -= $bikri->mazdori;
        $total -= $bikri->karaya;
        $total -= $bikri->daak;
        $total -= $bikri->store;

        $bikri->is_paid = 1;

        $bikri->safi_bikri = $total;
        $bikri->save();

        $cashBook = new CashBook;
        $cashBook->transaction_type = 'debited';
        $cashBook->total_ammount = $bikri->safi_bikri;
        $cashBook->description = $bikri->safi_bikri . "/- Rupees debited from Cash book. [Cash paid to Provider]";
        $cashBook->save();
        $owners = Owners::all();
        foreach($owners as $owner){
            $percentageOfOwner = $owner->share;
            $ownerCash = ($comissionCash/100) * $percentageOfOwner;
            $owner->net_worth += $ownerCash;
            $owner->save();
        }
        return redirect()->back();
    }
}
