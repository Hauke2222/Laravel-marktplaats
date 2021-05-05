<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ZipCodeController;
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

Route::get('/search', [AdvertController::class, 'search']);
Route::resource('adverts', AdvertController::class);

Route::resource('advertisers', AdvertiserController::class)->middleware('role:advertiser');

Route::resource('bids', BidController::class)->middleware('auth');

Auth::routes();

Route::resource('adverts', AdvertController::class)->only([
    'create', 'store', 'update', 'destroy'
    ])->middleware('role:advertiser');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
