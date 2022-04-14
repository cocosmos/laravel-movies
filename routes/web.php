<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
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

Route::get("/", [CinemaController::class, 'index'])->name('home');

Route::get('dashboard', function () {
    return view('dashboard' . "UserController@profile");
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get("profile", "UserController@profile")->middleware("auth");


Route::prefix('movie')->group(function () {
    //Route::get("/", ['as' => 'movie', 'uses' => 'MovieController@movie']);
    Route::get('{movie}/actors', [MovieController::class, 'actors'])->name('movie.actors');
    Route::post('{movie}/actors', [MovieController::class, 'attach'])->name('movie.attach');
    Route::get('{movie}/actors/{actor}', [MovieController::class, 'detach'])->name('movie.detach');
});


Route::prefix('artist')->group(function () {
    Route::get('{artist}/filmography', [ArtistController::class, 'hasPlayed'])->name('artist.filmography');
    //    Route::get('{artist}/directed', [ArtistController::class, 'hasDirected'])->name('artist.filmography');
});


Route::resource("artist", ArtistController::class);
Route::resource("country", CountryController::class);
Route::resource("movie", MovieController::class);
Route::resource("cinema", CinemaController::class);
Route::resource("room", RoomController::class);
Route::resource("session", SessionController::class);



