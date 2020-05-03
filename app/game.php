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
 		$api->replaceDetails['gameid'] = $this->steamid;
 		$gameDetails = $api->gameDetails();
 	//	dd($gameDetails);
		$this->name = $gameDetails->name;
		$this->isfree = $gameDetails->is_free;
		$this->image = $gameDetails->header_image;
		$this->description = $gameDetails->detailed_description;

		foreach( $gameDetails->categories as $category ){
			$catobject = \App\gamecategory::where("steamid",$category->id)->first();

			//If it's a new category, create it
			if( !$catobject ){
				$attributes = [
					"steamid"=> 		$category->id,
					"name"=> 	$category->description
				];
				$catobject = \App\gamecategory::create( $attributes );				
			}

			$this->categories()->save($catobject);
		}

		$this->save();
 	}
}
