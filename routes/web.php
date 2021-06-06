<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\AnimeController;

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
    return view('auth.login');
});

Route::get('/personaje', function () {
    return view('personaje.index');
});


Route::get('/anime', function () {
    return view('anime.index');
});

/*

Route::get('/personaje/create',[PersonajeController::class,'create']);

Route::get('/anime/create',[AnimeController::class,'create']);
*/


/*
Route::get('/empleado', function () {
    return view('empleado.index');
});


Route::get('empleado/create', [EmpleadoController::class, 'create']);
*/

Route::resource('personaje', PersonajeController::class)->middleware('auth');
Route::resource('anime', AnimeController::class)->middleware('auth');

Auth::routes(['register'=>true,'reset'=>true]);

Route::get('/home', [AnimeController::class, 'index'])->name('home');

Route::group([ 'middleware' => 'auth'], function(){

    Route::get('/home', [AnimeController::class, 'index'])->name('home');
});