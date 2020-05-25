<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['web']], function () {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/player/{steamname}', 'playerController@show');
	Route::get('/player/{steamname}/scan', 'playerController@scanLibrary');
	Route::get('/game/{steamid}', 'gameController@show');
	Route::get('/test', 'PlayerGroupController@show');
	Route::get('/playerGroup', 'PlayerGroupController@show');
	Route::get('/playerGroup/list', "playerGroupController@listPlayers" );
	Route::get('/player/{playerId}/addToPlayerGroup', "playerGroupController@addPlayerToGroup" );
	Route::get('/player/{playerId}/removeFromPlayerGroup', "playerGroupController@removePlayerFromGroup" );
});