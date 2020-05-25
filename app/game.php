<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class game extends Model
{
 	
 	protected $table = "games";
 	protected $primaryKey = "id";
 	public $incrementing = true;
 	public $keyType = "int";
 	protected $guarded = ['id'];

 	public function categories(){
 		return $this->belongsToMany("\App\gamecategory", "gamecategorylink",  "gameId", "categoryId");
 	}

 	public function updateDetails(){
 		$api = new \App\api();
 		$api->replaceDetails['gameid'] = $this->steamId;
 		//dd($api);
 		$gameDetails = $api->gameDetails();
 		if($gameDetails){
 		
			$this->name = $gameDetails->name;
			$this->isfree = $gameDetails->is_free;
			$this->image = $gameDetails->header_image;
			$this->description = $gameDetails->detailed_description;
			$this->background = $gameDetails->background;
			if( isset($gameDetails->metacritic)){
				$this->metacritic = $gameDetails->metacritic->score;
			}
			$this->save();
			if( isset($gameDetails->categories)){
				foreach( $gameDetails->categories as $category ){
					$catobject = \App\gamecategory::where("steamId",$category->id)->first();

					//If it's a new category, create it
					if( !$catobject ){
						$attributes = [
							"steamId"=> 		$category->id,
							"name"=> 	$category->description
						];
						$catobject = \App\gamecategory::create( $attributes );				
					}

					$this->categories()->save($catobject);
				}
			}
		}

 	}
}
