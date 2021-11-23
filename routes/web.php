<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('index');
Route::resource('/posts','PostController');

Route::get('/vue-posts', 'HomeController@listPostsApi')->name('listPostsApi');


Route::resource('/posts', 'Api\Postcontroller')->middleware('api_token_check');


Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
->group(function(){
    //pagina di atterraggio dopo il login (con il prefix, l'url è /admin)
    Route::get('/', 'HomeController@index')->name('index');
    
    Route::resource('/posts', 'PostController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    // Rotte per la pagina profilo
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::post('generate-token', 'HomeController@generateToken')->name('generate-token');
});

Route::get('/{any}', 'HomeController@index')->where('any', '.*');