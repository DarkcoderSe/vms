<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CurrentPasswordCheck;
use Hash;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile.edit');
    }
    public function update(Request $request){

        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
    public function password(Request $request){
        $request->validate([
            'old_password' => ['required', 'min:6', new CurrentPasswordCheck],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
    //
}
