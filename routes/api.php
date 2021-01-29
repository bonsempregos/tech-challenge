<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'genres' => GenreController::class,
    'movies' => MovieController::class,
    'actors' => ActorController::class,
    'movie-roles' => MovieRoleController::class,
]);

Route::get('/actors/{actor}/movies', 'ActorController@movies')->name('actors.movies');
Route::get('/actors/{actor}/favourite-genre', 'ActorController@favouriteGenre')->name('actors.fav');


