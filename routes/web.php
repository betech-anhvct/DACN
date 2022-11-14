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

Route::get('/shopProduct', [
    'uses' => 'App\Http\Controllers\ProductsController@getProduct'
]);

route::get('/shopProductDetail/{sid}',[
    'uses' => 'App\Http\Controllers\ProductsController@getProductDetail'
]);
route::get('/contact', function (){
    return view('userPage.contact');
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
    'uses' => function () {
        return view('adminPage.users');
    }
]);

Route::get('/admin/users', [
    'uses' => 'App\Http\Controllers\UserController@getUser'
]);

Route::get('/admin/users/create', [
    'uses' => 'App\Http\Controllers\UserController@createUser'
]);

Route::post('/admin/users/create', [
    'uses' => 'App\Http\Controllers\UserController@storeUser'
]);

Route::get('/admin/users/update/{id}', [
    'uses' => 'App\Http\Controllers\UserController@showUser'
]);

Route::post('/admin/users/update/{id}', [
    'uses' => 'App\Http\Controllers\UserController@updateUser'
]);

Route::post('/admin/{model}/delete/{id}', [
    'uses' => 'App\Http\Controllers\BaseController@delete'
]);

Route::get('/admin/category', [
    'uses' => 'App\Http\Controllers\CategoriesController@getCategory'
]);

Route::get('/admin/product', [
    'uses' => 'App\Http\Controllers\ProductsController@getProductAdmin'
]);

Route::get('/admin/product/create', [
    'uses' => 'App\Http\Controllers\ProductsController@createProduct'
]);

Route::post('/admin/product/create', [
    'uses' => 'App\Http\Controllers\ProductsController@storeProduct'
]);

Route::get('/admin/product/update/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@showProduct'
]);

Route::post('/admin/product/update/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@updateProduct'
]);

Route::post(
    '/admin/product/img ',
    function () {
        return response('1');
    }
);

//-----------------------------END-ADMIN-PAGE----------------------------------//
