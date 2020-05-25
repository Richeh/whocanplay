<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class playerGroup extends Model
{
    public $players = Array();
    public $games = Array();
    public $playerCounts = Array();

    public function addPlayer( $steamId ){
    	$this->players[] = $steamId;
    }

    public function communalGames(){
    	if( count($this->games) > 0 ){
    		return $this->games;
    	}
    	else{
    		$this->recalculateGames();
    		return $this->games;
    	}
    }

    public function recalculateGames(){
    	$api = new \App\Api();
   	 	foreach( $this->players as $player){
   	 		$steamGames = $api->playersGames( $player->steamId );
   	 		foreach($steamGames as $steamGame){
   	 			$steamId = $steamGame->appid;
   	 			if( !isset( $this->games[$steamId]) ){
   	 				$steamGame->players = Array($player->steamId);
   	 				$this->playerCounts[$steamId] = Array($player->steamId);
   	 				$this->games[$steamId] = $steamGame;
   	 			}
   	 			else{
   	 				$this->playerCounts[$steamId][] = $player->steamId;
   	 				$this->games[$steamId]->players[] = $player->steamId;
   	 			}
   	 		}
    	}
    }

    public function mutualGames( $ubiquity = 0.75 ){
    	$this->recalculateGames();
    	$minPlayerCount = $ubiquity * count( $this->players );
    	$gameList = Array();
    	$validCategories = Array(
    		"Remote Play Together" => 44,
    		"Multi-player" => 1    		
    		);
   
   	   	foreach( $this->games as $gameobj ){

    		$game = \App\game::where("steamid", $gameobj->appid)->first();
    		if(!$game){
    			//Load game from Steam
    			$game = new \App\Game;	
    			$game->steamId = $gameobj->appid;
    			$game->updateDetails();
    		}

	    	$categories = $game->categories()->get();
	    	//If many players have the game
	    	if(count( $this->playerCounts[$game->steamId] ) > $minPlayerCount ){
	    		$gameList[] = $game;
	    	}
	    	else{
	    	//If remote play together is available
	    	foreach( $categories as $category){
	    		if($category->steamid == $validCategories["Remote Play Together"]){
	    				$gameList[] = $game;
		   			}
		   		}
		   	}
	    	
    	}
    	return $gameList;
    }

}
