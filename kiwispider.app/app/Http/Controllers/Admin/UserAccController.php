<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserAccController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}
    public function index()
    {

        return User::all();
    }

    public function destroy($id)
    {
    	$users = User::find($id);
    	$users->delete();
        return User::all();
    }
    public function add(Request $request)
    {
        
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt(123456);
        $user->save();

        return User::all();
    }
}
