<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\FilmTypePivotController;
use App\Http\controllers\RoleController;
use App\Http\controllers\FrontendController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//dashborad Admin
Route::group(['middleware' => ['auth','checkAdmin']], function() {
    // view dashborad admin
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    // view show users
    Route::get('/showUser', [App\Http\Controllers\UserController::class, 'index'])->name('show.user');
    //film 
       Route::resource('film',FilmController::class);
       Route::get('/gettypes/{id}', [FilmController::class, 'getTypes'])->name('getTypes');
       //type
       Route::resource('type',TypeController::class);
       //Film_Type
       Route::resource('film_Type',FilmTypePivotController::class);
       Route::resource('roles',RoleController::class);
       Route::resource('users',UserController::class);

});
//show details film
Route::group(['middleware' => 'auth'], function() {

 Route::get('/details/{id}',[FrontendController::class,'show'])->name('showdetails');
});
//test relation
      
Route::get('film/{id}', [FilmController::class, 'film'])->name('film');
Route::get('getfilm/{id}', [FilmController::class, 'getFilm'])->name('getfilm');


