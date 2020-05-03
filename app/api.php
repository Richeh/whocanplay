<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api extends Model
{
	public $replaceDetails = Array();



    public function gameDetails(){
		$url = $this->fillDetails("https://store.steampowered.com/api/appdetails?appids=%gameid%");
		$response = $this->makeApiRequest( $url );
		$gameid = $this->replaceDetails['gameid'];

		foreach( $response as $id => $gameQuery ){
			if($gameQuery->success == true){
				return $gameQuery->data;
			}
			else{
				return false;
			}
		}
    }

    public function playersDetails(){
		$url = $this->fillDetails("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%apikey%&steamids=%userid%");
		$response = $this->makeApiRequest( $url );
		return $response;
    }

    public function playersGames(){
		$url = $this->fillDetails("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=%apikey%&include_appinfo=true&steamid=%steamid%&format=json");
		$response = $this->makeApiRequest( $url );
		return $response;
    }

    public function playersFriends(){
		$url = $this->fillDetails("http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=%apikey%&steamid=%steamid%&relationship=friend");
		$response = $this->makeApiRequest( $url );
		return $response;
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
		$data = file_get_contents($url);
		$response = json_decode($data);
		return $response;
	}
}
