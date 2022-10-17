<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
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

//-----------------------------USER-PAGE------------------------------------//

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

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', 'App\Http\Controllers\LoginController@postRegister');

Route::get('/shopProduct', function () {
    return view('userPage.shopProducts');
});

//-----------------------------END-USER-PAGE-----------------------------------//

//-----------------------------ADMIN-PAGE--------------------------------------//
Route::get('/admin', function () {
    if (Auth::check()) {
        if (Auth::user()->role != 0) {
            return view('adminPage.home');
        }
    }
    return redirect(url('/index'));
});

Route::get('/admin/users', [
    'as' => 'usersAP',
    'uses' => function(){
        return view('adminPage.users');
    }
]);

Route::get('/admin/getUsers', [
    'uses' => 'App\Http\Controllers\UserController@getUser'
]);
//-----------------------------END-ADMIN-PAGE----------------------------------//
