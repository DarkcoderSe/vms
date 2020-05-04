<?php
namespace App\Http\Controllers;

use App\agent;
use App\User;

use Illuminate\Http\Request;

class agentController extends Controller
{
       public function index()
    {
         $users = User::all();
        return view('agent.index')->with([
            'users' => $users
        ]);
    }
    public function create()
    {
        return view('agent.create');
    }
 
    public function store(Request $request){
    
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:15'],
            'contact' => [ 'required','string','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        try{ 
            $user = new User;
            $user->name = $request->name;
            $user->contact = $request->contact;
            $user->email = $request->email;
            $user->password = bcrypt(request('password'));
            $user->save();
        }
        catch(\Throwable $th){ 
         return redirect()->back()->with([
            'error' => true,
            'message' => 'Error 500: Server side error'
        ]);   
    }
    return redirect()->back()->with([
        'success' => true,
        'message' => 'agent record submitted successfully'
    ]);

    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('index');
    }
}
