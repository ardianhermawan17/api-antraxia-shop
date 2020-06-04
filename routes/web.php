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

//Route::get('/', function () {
//    return view('home');
//});


//-------------------ADMIN ROUTE-----------------///


//ADMIN
Route::prefix('/admin')->group(function (){

    //GOOGLE API
    Route::get('google', 'GoogleController@redirect')->name('google.login');
    Route::get('google/callback', 'GoogleController@callback')->name('google.callback');

    //home
    Route::get('/home', 'HomeController@index')->name('home');

    //login
    Route::get('/', 'Admin\UserController@login')->name('auth.login');

    Route::match(["GET","POST"],"/register", function (){
        return redirect("/login");
    })->name("register");

    //USER
    Route::resource("users","Admin\UserController");

    //Category
    Route::get('/categories/trash','Admin\CategoryController@trash')->name('categories.trash');
    Route::get('/categories/{id}/restore','Admin\CategoryController@restore')->name('categories.restore');
    Route::delete('/categories/{category}/delete-permanent',
        'Admin\CategoryController@deletePermanent')->name('categories.delete-permanent');
    Route::get('ajax/categories/search','Admin\CategoryController@ajaxSearch')->name('categories.ajax-search');
    Route::resource('categories','Admin\CategoryController');

    //Books
    Route::get('/books/trash','Admin\BookController@trash')->name('books.trash');
    Route::post('/books/{book}/restore','Admin\BookController@restore')->name('books.restore');
    Route::delete('/books/{id}/delete-permanent','Admin\BookController@deletePermanent')->name('books.delete-permanent');
    Route::resource('books','Admin\BookController');

    //Orders
    Route::resource('orders','Admin\OrderController');

    Auth::routes();
});
