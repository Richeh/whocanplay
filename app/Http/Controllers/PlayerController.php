<?php

namespace App\Http\Controllers;

use App\player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($steamid)
    {
        $player = new \App\player;

        $player->steamid = $steamid;
        $details = $player->steamdetails();
        $friends = $player->friends();
        $games   = $player->games();

        return view("players.show", ["friends"=>$friends, "details"=>$details, "games"=>$games]);
        if( $game ){
        }
        else{
            $attributes = ["steamid"=>$gameid, "name"=>"temp"];
            $game = \App\Game::create( $attributes );
            $game->updateDetails();
            return view("games.show", ["game" => $game]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(player $player)
    {
        //
    }
}
