<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
     public function login(){
        /**
         * 
         */

         if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $user->api_token = $success['token'];
            $user->save();
            return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
         }
         else{
            return response()->json(['error'=>'Unauthorised'], 401);
         }
     }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        try {


            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;

        } catch (\Throwable $th) {
            // return $th;
            return response()->json(['code' => 403, 'message' => 'Query Failed']);

        }

        return response()->json(['success'=>$success], $this->successStatus);
    }


    //
}
