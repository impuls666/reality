<?php

namespace App\Http\Controllers;

use App\Marker;
use Illuminate\Http\Request;

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
    public function store()
    {

    }

    public function posts($id){

        $post =     Marker::find($id);

         return view('details')->with('post',$post);


    }


}
