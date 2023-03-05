<?php

use App\Http\Controllers\EventController;
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

Route::view('/', 'welcome')->name('home');
Route::view('/events', 'web.events')->name('events');
Route::view('/club', 'web.club')->name('club');
Route::get('/events/{event}/galery', [ HashController::class, 'galery' ])->name('galery');
Route::view('/events/{event}/purchase', 'web.purchase')->name('purchase');

Route::prefix('dashboard')->middleware(['auth', 'role:admin'])->group(function()
{
    Route::controller(EventController::class)->group(function()
    {
        Route::get('/', 'index')->name('events.index');
        Route::get('/{event}', 'show')->name('events.show');
        Route::get('/{event}/settings', 'settings')->name('events.settings');
    });

    Route::controller(HashController::class)->prefix('hashes')->group(function()
    {
        Route::get('/', 'index')->name('dashboard.hashes.index');
        Route::get('/create', 'create')->name('dashboard.hashes.create');
        Route::post('/create', 'save')->name('dashboard.hashes.save');
        Route::get('/edit/{hash}', 'edit')->name('dashboard.hashes.edit');
        Route::put('/edit/{hash}', 'update')->name('dashboard.hashes.update');
        Route::delete('/edit/{hash}', 'delete')->name('dashboard.hashes.delete');
        Route::put('/request-qr/{hash}', 'requestQr')->name('dashboard.hashes.approvate');
        Route::get('/download-invitation/{hash}', 'downloadInvitation')->name('dashboard.hashes.invitation');
    });
});

require __DIR__.'/auth.php';

Route::controller(HashController::class)->group(function()
{
    Route::post('/events/{event}/register-voucher', 'registerVoucher')->name('register-voucher');
    Route::get('register-hash', 'registerHash')->middleware([ 'auth:sanctum', 'unused-hash', 'role:admin' ])->name('register-hash');
    Route::view('confirmation', 'web.confirmation')->name('confirmation');
    Route::view('denied', 'web.denied')->name('denied');
    Route::view('approved', 'web.approved')->name('approved');
});
