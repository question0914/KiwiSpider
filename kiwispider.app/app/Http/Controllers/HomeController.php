<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function get_your_account() 
    {
        return Auth::user();
    }

    public function get_user()
    {
        $id = Auth::user()->id;
        return DB::table('users')->where('users.id','!=',$id)->get();           /*get all user except current login*/
    }
}
