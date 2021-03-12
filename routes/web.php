<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AdvertiserController;
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

Route::redirect('/', '/adverts');

Route::resource('adverts', AdvertController::class);

Route::resource('advertisers', AdvertiserController::class)->middleware('role:advertiser');

Route::resource('bids', BidController::class);

Auth::routes();

Route::resource('adverts', AdvertController::class)->only([
    'create', 'store', 'update', 'destroy'
    ])->middleware('role:advertiser');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
