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
    public function show(Request $request, $steamId)
    {
        $player = new \App\player;
        $player->steamId = $steamId;
        $details = $player->steamdetails();
        $friends = $player->friends();
        $games   = $player->games();
        $playerIds = $request->session()->get("playersInGroup");
        $playerObjects = Array();
        $playerGroup = new \App\playerGroup();
        $playerGroup->loadFromSession();

        if(is_array($playerIds)){
            foreach( $playerIds as $playerId => $true){
                $playerObj = new \App\Player();
                $playerObj->steamId = $playerId;
                $playerObjects[] = $playerObj;
            }
        }



        return view("players.show", ["friends"=>$friends, "details"=>$details, "games"=>$games, "playerGroup"=>$playerGroup]);
    }


    public function scanLibrary( $steamId ){
        $player = new \App\player;

        $player->steamId = $steamId;
        $games   = $player->games();
       // dd($games);
        $maxscan = 10;
        $gamecount = count($games)-1;
        if( $maxscan > $gamecount){
            $maxscan = $gamecount;
        }
        $scanned = 0;
        $peeped = 0;
        try{
            while( $scanned <= $maxscan-1 && $peeped < $gamecount ){
                $game = array_pop($games);
                $peeped++;

                if( $game->appid ){
                    $gameObj = \App\Game::where("steamId", $game->appid)->first();
                    if( !$gameObj ){
                        
                        $attributes = ["steamId"=>$game->appid, "name"=>"temp"];                
                        $gameObj = new \App\Game($attributes);
                   //     dd($gameObj);
                       // $gameObj->updateDetails();
                        $scanned++;

                    }
                }
              //  sleep(0.2);
            }
            
        }            
        catch (ClientException $e) {
            $req = $e->getRequest();
            $resp =$e->getResponse();
            displayTest($req,$resp);
        }
        catch(Exception $e){
            return back()->withErrors(['msg', 'The Steam API is pretty busy.  Trying again in a few seconds might help!']);
        }    
        return back()->with("msg", "Hey thanks - we found ".$scanned." titles that WCP didn't even know about!");
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
