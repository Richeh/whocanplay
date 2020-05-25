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
    	$playersdetails = $api->playersDetails();
    	return $playersdetails;
    }

    public function games(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamId" => $this->steamId ];
    	$playersdetails = $api->playersGames();
    	return $playersdetails;
    }
}
