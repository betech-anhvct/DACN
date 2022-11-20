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

Route::get('/shopProduct/category/{category}', [
    'uses' => 'App\Http\Controllers\ProductsController@findByCategory'
]);

Route::get('/shopProduct/search', [
    'uses' => 'App\Http\Controllers\ProductsController@searchProduct'
]);

route::get('/shopProductDetail/{sid}', [
    'uses' => 'App\Http\Controllers\ProductsController@getProductDetail'
]);
route::get('/contact', function () {
    return view('userPage.contact');
});
//-----------------------------cart---------------------------//
Route::get('/cart', 'App\Http\Controllers\CartController@getCart');

Route::post(
    'add2cart',
    [
        'as' => 'them-gio-hang',
        'uses' => 'App\Http\Controllers\CartController@add2Cart',
    ]
);
// Route::post('/cart', function () {
//     return view('userPage.cart');
// });

Route::post(
    'updatecart',
    [
        'as' => 'cap-nhat-gio-hang',
        'uses' => 'App\Http\Controllers\CartController@changeQuantity'
    ]
);

Route::post(
    'deletefromcart',
    [
        'as' => 'xoa-gio-hang',
        'uses' => 'App\Http\Controllers\CartController@delCartItem'
    ]
);
//-----------------------------checkout---------------------------//
Route::get('/checkout', function () {
    return view('userPage.checkout');
});



//-----------------------------END-USER-PAGE-----------------------------------//

//-----------------------------ADMIN-PAGE--------------------------------------//
Route::get('/admin', function () {
    if (Auth::check()) {
        if (Auth::user()->role != 0) {
            return redirect('admin/users');
            // return view('adminPage.home');
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

Route::get('/admin/category/create', [
    'uses' => 'App\Http\Controllers\CategoriesController@createCategory'
]);

Route::post('/admin/category/create', [
    'uses' => 'App\Http\Controllers\CategoriesController@storeCategory'
]);

Route::get('/admin/category/update/{id}', [
    'uses' => 'App\Http\Controllers\CategoriesController@showCategory'
]);

Route::post('/admin/category/update/{id}', [
    'uses' => 'App\Http\Controllers\CategoriesController@updateCategory'
]);

Route::get('/admin/voucher', [
    'uses' => 'App\Http\Controllers\VoucherController@getVoucher'
]);

Route::get('/admin/voucher/create', [
    'uses' => 'App\Http\Controllers\VoucherController@createVoucher'
]);

Route::post('/admin/voucher/create', [
    'uses' => 'App\Http\Controllers\VoucherController@storeVoucher'
]);

Route::get('/admin/voucher/update/{id}', [
    'uses' => 'App\Http\Controllers\VoucherController@showVoucher'
]);

Route::post('/admin/voucher/update/{id}', [
    'uses' => 'App\Http\Controllers\VoucherController@updateVoucher'
]);

//-----------------------------END-ADMIN-PAGE----------------------------------//
Route::get('/admin/order', [
    'uses' => 'App\Http\Controllers\OrdersController@getOrder'
]);

Route::get('/admin/order/create', [
    'uses' => 'App\Http\Controllers\OrdersController@createOrder'
]);

Route::post('/admin/order/create', [
    'uses' => 'App\Http\Controllers\OrdersController@storeOrder'
]);

Route::get('/admin/order/update/{id}', [
    'uses' => 'App\Http\Controllers\OrdersController@showOrder'
]);

Route::post('/admin/order/update/{id}', [
    'uses' => 'App\Http\Controllers\OrdersController@updateOrder'
]);
//-----------------------------END-ADMIN-PAGE----------------------------------//
