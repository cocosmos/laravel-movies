<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get("profile", "UserController@profile")->middleware("auth");


Route::resource("artist", ArtistController::class);
Route::resource("country", CountryController::class);
Route::resource("movie", MovieController::class);
Route::resource("cinema", CinemaController::class);
Route::resource("room", RoomController::class);
Route::resource("session", SessionController::class);



