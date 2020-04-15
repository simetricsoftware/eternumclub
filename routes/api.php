<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;

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
    return new UserResource($request->user());
});

Route::namespace('api')->group(function() {

    Route::prefix('posts')->group(function() {
        Route::get('/', 'PostController@index');
        Route::get('recents', 'PostController@recents');
        Route::get('{post:slug}', 'PostController@show');
        Route::put('{post:slug}/vote', 'PostController@vote');

        Route::resource('{post:slug}/comments', 'CommentController')->except('create', 'edit', 'show');
        Route::put('{post:slug}/comments/{comment}/vote', 'CommentController@vote');
    });

    Route::get('categories', 'CategoryController@index');
});
