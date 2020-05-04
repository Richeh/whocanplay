<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class player extends Model
{
    public function friends(){
    	$api = new \App\api();
    	$api->replaceDetails = [ "steamid" => $this->steamid ];
    	$friends = [];
    	foreach( $api->playersFriends() as $friend ){
    		$friendo = new \App\Player;
    		$friendo->steamid = $friend->steamid;
    		$friends[] = $friendo;
    	}
    	return $friends;
    }

    public function steamdetails(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamid" => $this->steamid ];
    	$playersdetails = $api->playersDetails();
    	return $playersdetails;
    }

    public function games(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamid" => $this->steamid ];
    	$playersdetails = $api->playersGames();
    	return $playersdetails;
    }
}
