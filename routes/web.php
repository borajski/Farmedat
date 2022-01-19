<?php

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

// Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Back routes //

Route::get('/backend', function () {
    return view('back.layouts.backend_base');
});

Route::get('/profile', function () {
    return view('back.layouts.users.user_profile');
});

Route::resource('user', 'UsersController');
Route::get('/korisnici','UsersController@index');
Route::get('brisi_korisnika/{id}','UsersController@destroy');

Route::resource('group', 'GroupsController');
Route::get('/grupe','GroupsController@index');
Route::get('group/{{id}}', [GroupsController::class, 'show'])->name('grupa');
Route::get('brisi/{id}','GroupsController@destroy');

Route::resource('category', 'CategoriesController');
Route::get('group/brisi/{id}','CategoriesController@destroy');
Route::get('category/{{id}}', [CategoriesController::class, 'show'])->name('kategorija');

Route::resource('subcategory', 'SubcategoriesController');
Route::get('category/brisi/{id}','SubcategoriesController@destroy');
Route::get('subcategory/{{id}}', [SubcategoriesController::class, 'show'])->name('podkategorija');

Route::resource('message', 'MessagesController');
Route::get('/poruke','MessagesController@index')->name('poruke');
Route::get('getUserId', 'MessagesController@getUserId');
Route::get('message/{{id}}', [MessagesController::class, 'show'])->name('poruka');
Route::get('message/brisi/{id}','MessagesController@destroy');

Route::resource('product', 'ProductsController');
Route::get('/proizvodi','ProductsController@index');
Route::get('spremi','ProductsController@store');
Route::get('dajvrstu', 'ProductsController@dajvrstu');
Route::get('product/brisiSliku/{id}', 'ProductsController@brisiSliku');
Route::get('product/{{id}}', [ProductsController::class, 'show'])->name('product');
Route::get('urediAkciju','ProductsController@updateAction')->name('urediAkciju');

Route::resource('action', 'ProductActionsController');
Route::get('/proizvodi_akcije','ProductActionsController@index');
Route::get('akcija/brisi/{id}','ProductActionsController@destroy');

Route::resource('vendor', 'VendorsController');
Route::get('/prodavaci','VendorsController@index');

Route::resource('order', 'OrdersController');
Route::get('/narudzbe','OrdersController@index');
Route::get('/naruceno','OrdersController@index_buy');
Route::get('/narudzba/{{id}}','OrdersController@show');

Route::resource('follower', 'FollowersController');
Route::get('/pratnja','FollowersController@index');
Route::get('/kupci','FollowersController@index_buyers');
Route::get('/pratim','FollowersController@index_follow');

// Front routes //

Route::get('/prodaja', 'ProductsController@index_front');
Route::get('cart', 'ProductsController@cart');
Route::get('/naplata', function () { return view('front.naplata');
});
Route::get('/kosarica', function () { return view('front_layouts.naplata.kosarica');
});
Route::get('add-to-cart/{id}/{n}', 'ProductsController@addToCart');
Route::patch('update-cart', 'ProductsController@updateCart');
Route::delete('remove-from-cart', 'ProductsController@remove');

Route::get('/izlog-prodavaca','VendorsController@front_index');
Route::get('/prodavac/{id}','VendorsController@front_show');

Route::get('/proizvod/{id}','ProductsController@front_show');

Route::get('/spremi/{id}','FollowersController@spremi');

Route::get('grupa/{id}','GroupsController@front_show');

Route::get('grupa/kategorija/{id}','CategoriesController@front_show');

Route::get('grupa/kategorija/podkategorija/{id}','SubcategoriesController@front_show');

