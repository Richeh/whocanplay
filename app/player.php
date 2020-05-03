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
    		$friends[] = new \App\Player();
    	}
    }

    public function steamdetails(){
    	$api = new \App\api;
    	$api->replaceDetails = [ "steamid" => $this->steamid ];

    	$playersdetails = $api->playersdetails();
    	return $playersdetails;
    }
}
