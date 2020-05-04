<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Owners;

class OwnerController extends Controller
{

    public function listOfOwners(){
        $owners = Owners::all();

        return response()->json([
            'owners' => $owners
        ], 200);
    }
}
