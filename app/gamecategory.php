<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gamecategory extends Model
{
 
 	protected $table = "gamecategories";
 	protected $primaryKey = "id";
 	public $incrementing = true;
 	public $keyType = "int";
 	protected $guarded = ['id'];

 	public function games(){
 		return $this->belongsToMany("\App\gamecategory", "gamecategorylink", "gameId", "categoryId");
 	}
}
