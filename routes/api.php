<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Book as BookResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('nama', function (){
    return 'Namaku, Larashop API';
});

Route::post('umur', function (){
   return 17;
});

Route::get('category/{id}', function ($id) {
    $categories = [
        1 => 'Programming',
        2 => 'Desain Grafis',
        3 => 'Jaringan Komputer',
    ];
    $id = (int) $id;
    if($id==0) return 'Silakan pilih kategori';
    else return 'Anda memilih kategori <b>'.$categories[$id].'</b>';
});

// BOOK
Route::get('/book-scaff', function () {
    return new BookResource(\App\Book::find(1));
});
Route::get('book/{id}', function () {
    return 'buku angka';
})->where('id','[0-9]+');

Route::get('book/{title}', function ($title) {
    return 'buku abjad';
})->where('title', '[A-Za-z]+');



//ROute test

//Route::get('test',function (){
////    $faker = Faker\Factory::create();
////    $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
////
////        $image = $faker->picsumUrl(400,200);
////        $contents = file_get_contents($image);
////        $name = substr($image, strpos($image , '/') +1 );
////        $hash = \Illuminate\Support\Facades\Hash::make($name) .'.jpg';
////
////        return $contents;
//});


//BOOK controller

Route::middleware(['throttle:10,1','cors'])->group(function () {
    Route::get('buku/{judul}', 'BookController@cetak');
});

//Category
Route::resource('categories','CategoryController');


//Auth API
Route::middleware(['cors'])->group(function () {
    Route::prefix('v1')->group(function () {
        // PUBLIC
        Route::post('login', 'AuthController@login');
        //  register dan logout :
        Route::post('register', 'AuthController@register');

        Route::get('books', 'BookController@index');
        Route::get('book/{id}', 'BookController@view')->where('id', '[0-9]+');

        Route::get('categories/random/{count}','CategoryController@random'); // <== random
        Route::get('categories','CategoryController@index');
        Route::get('categories/slug/{slug}','CategoryController@slug');

        Route::get('books/top/{count}','BookController@top');
        Route::get('books','BookController@index');
        Route::get('books/slug/{slug}', 'BookController@slug');
        Route::get('books/search/{keyword}','BookController@search');

        Route::get('provinces','ShopController@provinces');
        Route::get('cities','ShopController@cities');
        Route::get('couriers','ShopController@couriers');

        // PRIVATE
        Route::middleware('auth:api')->group(function (){
            Route::post('shipping','ShopController@shipping');
            Route::post('logout','AuthController@logout');
            Route::post('services','ShopController@services');
            Route::post('payment','ShopController@payment');
            Route::get('my-order','ShopController@myOrder');
        });

        Route::get('midtrans-notif','ShopController@midtransNotif');
    });
});
