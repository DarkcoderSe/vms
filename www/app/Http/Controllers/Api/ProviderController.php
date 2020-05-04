<?php


namespace App\Http\Controllers\Api;


use App\Customer;
use App\Http\Controllers\Controller;
use App\Provider;

class ProviderController extends Controller
{

    public function listOfProviders(){
        $providers = Provider::all();

        return response()->json([
            'providers' => $providers
        ], 200);
    }
}
