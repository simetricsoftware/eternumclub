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

        Route::prefix('{post:slug}')->group(function() {
            Route::resource('comments', 'CommentController')->except('create', 'edit', 'show');
            Route::put('comments/{comment}/vote', 'CommentController@vote');
            Route::get('ticket-types', 'TicketTypeController@index');
            Route::get('questions', 'QuestionController@index');
            Route::get('bank-accounts', 'BankAccountController@index');
            Route::post('tickets', 'TicketController@store');
        });
    });

    Route::get('categories', 'CategoryController@index');
    Route::get('ticket-types', 'TicketTypeController@index');
});
