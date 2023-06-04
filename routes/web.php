<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


//Rutas con el prefijo dashboard para el módulo administrativo
Route::prefix('dashboard')->namespace('web\dashboard')->group(function() {

    //Rutas para las categorías
    Route::resource('categories', 'CategoryController')->except('destroy');

    //Rutas para las categorías
    Route::resource('tags', 'TagController')->except('destroy');

    //Rutas para los usuarios
    Route::resource('users', 'UserController');
    Route::put('users/restore/{user}', 'UserController@restore')->name('users.restore');
    Route::put('users/delete/{user}', 'UserController@delete')->name('users.delete');
    Route::post('users/images', 'UserController@uploadImage')->name('users.upload.image');
    Route::delete('users/images/{image}', 'UserController@deleteImage')->name('users.delete.image');

    //Rutas para los roles y permisos
    Route::resource('roles', 'RoleController');

    //Rutas para los posts
    Route::resource('posts', 'PostController');
    Route::prefix('posts/{post}')->group(function() {
        //Rutas subir una imagen
        Route::post('image', 'PostController@uploadImage')->name('posts.image');
        //Rutas para los comentarios
        Route::resource('comments', 'CommentController')->only(['index', 'show', 'destroy']);
        //Rutas para los tipos de entrada
        Route::resource('ticket-type', 'TicketTypeController')->except(['show']);
        Route::resource('questions', 'QuestionController')->only(['index', 'store']);
        Route::resource('bank-accounts', 'BankAccountController')->only(['index', 'store']);
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//Rutas para la web SPA
Route::namespace('web')->name('web.')->group(function() {
    Route::get('/', 'WebController@index')->name('index');
    Route::fallback('WebController@index');
});
