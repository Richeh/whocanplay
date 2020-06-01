<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class player extends Model
{

	public $steamId;
	
    public function friends(){
    	$api = new \App\api();
    	$api->replaceDetails = [ "steamId" => $this->steamId ];
    	$friends = [];
    	foreach( $api->playersFriends() as $friend ){
    		$friendo = new \App\Player;
    		$friendo->steamId = $friend->steamid;
    		$friends[] = $friendo;
    	}
    	return $friends;
    }

    public function steamdetails(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamId" => $this->steamId ];
        $loadedPlayersDetails = session("loadedPlayersDetails");
        if(!$loadedPlayersDetails){
            $loadedPlayersDetails = Array();
        }
        if(!array_key_exists($this->steamId, $loadedPlayersDetails)){
        //    dd($this->steamId);
         //   dd($loadedPlayersDetails);
            $playersdetails = $api->playersDetails();
            $loadedPlayersDetails[$this->steamId] = $playersdetails;
            session(["loadedPlayersDetails"=>$loadedPlayersDetails]);
        }
    	$playersdetails = $loadedPlayersDetails[$this->steamId];
    	return $playersdetails;
    }

    public function games(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamId" => $this->steamId ];
         $loadedPlayersGames = session("loadedPlayersGames");
        if(!$loadedPlayersGames){
            $loadedPlayersGames = Array();
        }
        if(!array_key_exists($this->steamId, $loadedPlayersGames)){
            $playersGames = $api->playersGames();
            $loadedPlayersGames[$this->steamId] = $playersGames;
            session(["loadedPlayersGames"=>$loadedPlayersGames]);
        }
        $playersgames = $loadedPlayersGames[$this->steamId];
    	return $playersgames;
    }
}
