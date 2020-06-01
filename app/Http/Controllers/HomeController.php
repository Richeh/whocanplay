<?php

namespace App\Http\Controllers;

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
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        
        return view("games.test");
    }

    public function faq(){
        return view("pages.faq");
    }
    public function flush(){
        session("loadedPlayersDetails", Array());
        session("loadedPlayersGames", Array());
        return back()->withMessage("msg", "Cache flushed");
    }
}
