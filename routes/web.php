<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HashController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(HashController::class)->group(function()
{
    Route::get('request-qr', 'requestQr')->name('request-qr');
    Route::get('register-hash', 'registerHash')->middleware([ 'auth:sanctum', 'unused-url' ])->name('register-hash');
});
