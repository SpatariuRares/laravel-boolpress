<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



// Stiamo richiedendo il seguente link: http://127.0.0.1:8000/api/posts
Route::post('/posts', 'Api\PostController@index')->middleware('api_token_check');

Route::post('post/{slug}', 'Api\PostController@show')->middleware('api_token_check');