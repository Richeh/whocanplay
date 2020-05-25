<?php

namespace App\Http\Controllers;

use App\playerGroup;
use Illuminate\Http\Request;

class PlayerGroupController extends Controller
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
     * @param  \App\playerGroup  $playerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

         /*$players = Array(
//    "76561197973219231",
            "76561198004384162", // Martin
            "76561198043912710", // Josh
            "76561198034274746", // Jim
            "76561198048106778", // Dave
            "76561198442941398"  // Yannick
        ); */
        $players = $request->session()->get("playersInGroup");
        $playerObjects = Array();
        $playerGroup = new \App\PlayerGroup;
        if(!is_array($players)){
            return back()->withErrors("msg", "No players in group");
        }
        foreach( $players as $playerId => $true){
            $playerObj = new \App\Player();
            $playerObj->steamId = $playerId;
            $playerObjects[] = $playerObj;
            $playerGroup->addPlayer($playerObj);
        }
        $games = $playerGroup->mutualGames(75/100);
        return view("playerGroups.show", Array(
            "games" => $games, 
            "playerCounts" => $playerGroup->playerCounts,
            "playerGroup" => $playerGroup));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\playerGroup  $playerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(playerGroup $playerGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\playerGroup  $playerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, playerGroup $playerGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\playerGroup  $playerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(playerGroup $playerGroup)
    {
        //
    }

    public function test(){
        $players = Array(
    "76561198004384162", // Martin
    "76561198043912710", // Josh
    "76561198034274746", // Jim
    "76561198048106778", // Dave
    "76561198442941398"  // Yannick
);
        $playerGroup = new \App\PlayerGroup;
        foreach( $players as $player ){
            $playerGroup->addPlayer($player);
        }

    }

    //Add a player to the session's player group
    public function addPlayerToGroup(Request $request, $playerId){
        $playersInGroup = $request->session()->get("playersInGroup");
        if( $playersInGroup ){
            $playersInGroup[$playerId] = true;
        }
        else{
            $playersInGroup = Array( $playerId => true );
        }
        $request->session()->put("playersInGroup", $playersInGroup);
        return back();
    }

    //Remove a player from the session's player group
    public function removePlayerFromGroup(Request $request, $playerId){
        $playersInGroup = $request->session()->get("playersInGroup");
        if( $playersInGroup ){
            unset($playersInGroup[$playerId]);
        }
        else{
            $playersInGroup = Array();
        }
        $request->session()->put("playersInGroup", $playersInGroup);
        return back();
    }

    public function listPlayers(Request $request){        
        return $request->session()->get("playersInGroup");
    }

}
