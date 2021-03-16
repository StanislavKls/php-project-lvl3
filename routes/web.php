<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlsController;
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
    return view('index');
})->name('home.index');

Route::get('/urls', [UrlsController::class, 'index'])
->name('urls.index');

Route::post('/urls/store', [UrlsController::class, 'store'])
->name('urls.store');

Route::get('/urls/{id}', [UrlsController::class, 'show'])
->name('urls.show');

Route::get('/test', function () {
    return view('test');
});
