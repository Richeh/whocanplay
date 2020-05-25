<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class api extends Model
{
	public $replaceDetails = Array();

    public function gameDetails(){
    	$this->checkRequirements(["gameid"]);
		$url = $this->fillDetails("https://store.steampowered.com/api/appdetails?appids=%gameid%");
		$response = $this->makeApiRequest( $url );
    	foreach( $response as $id => $gameQuery ){
			if($gameQuery->success == true){
				return $gameQuery->data;
			}
			else{
				return false;
			}
		}
    }

    public function checkRequirements($fields){
    	foreach( $fields as $field ){
    		if( !array_key_exists($field, $this->replaceDetails) || !$this->replaceDetails[$field]){
    			throw new \Exception("Missing details");
    		}
    	}
    }

    public function playersDetails(){
		$url = $this->fillDetails("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%apikey%&steamids=%steamId%");
		$response = $this->makeApiRequest( $url );
		foreach( $response as $blah ){
			return($blah->players[0]);
		}
    }

    public function playersGames( $steamId = null ){
    	if($steamId){
    		$this->replaceDetails['steamId'] = $steamId;
    	}
		$url = $this->fillDetails("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=%apikey%&include_appinfo=true&steamid=%steamId%&format=json");
		$response = $this->makeApiRequest( $url );
		if(isset($response->response->games)){
			return $response->response->games;
		}
		else{
			throw new \Exception("API busy");
		}
    }

    public function playersFriends(){
		$url = $this->fillDetails("http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=%apikey%&steamid=%steamId%&relationship=friend");
		$response = $this->makeApiRequest( $url );

		return $response->friendslist->friends;
    }

    function fillDetails( $url ){
    	$parameters = $this->replaceDetails;
    	$parameters['apikey'] = env("STEAM_API_KEY");

    	foreach( $parameters as $key => $detail ){
			$url = str_replace("%".$key."%", $detail, $url );
    	}
    	return $url;
    }

	function makeApiRequest( $url ){
	//	dd($url);
		$client = new \GuzzleHttp\Client();
		if($client){
			$response = $client->request("GET", $url);
		$body = $response->getBody();
		if($response->getStatusCode() == 200){
			return json_decode((string)$body);
		}
		else{
			throw new \Exception("API busy");
		}
		}
		
	}

}
