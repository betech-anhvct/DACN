<?php

use App\Http\Controllers\LoginController;
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
    return view('userPage.home');
});
Route::get('/index', function () {
    return view('userPage.home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', 'App\Http\Controllers\LoginController@logout');

Route::post('/login', 'App\Http\Controllers\LoginController@postLogin');

Route::get('/register', function(){
    return view('register');
});

Route::post('/register', 'App\Http\Controllers\LoginController@postRegister');
