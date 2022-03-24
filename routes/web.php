<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;


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
Route::resource("artist", ArtistController::class);
Route::resource("country", CountryController::class);
Route::resource("movie", MovieController::class);

/*
Route::prefix("movie")->group(function(){
    Route::get("{movie}/actors", [MovieController::class, "actors"])->name("movie.actors"); 
    Route::post("{movie}/attach", [MovieController::class, "attach"])->name("movie.attach"); 
    Route::delete("{movie}/detach/{artist}", [MovieController::class, "detach"])->name("movie.detach"); 
});

Route::resource("movie", "MovieController"); 
*/
