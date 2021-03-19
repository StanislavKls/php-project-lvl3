<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlsController;
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

Route::get('/', function (Request $request): Illuminate\View\View {
    $flash = $request->session()->get('status');
    return view('index', compact('flash'));
})->name('home.index');

Route::get('/urls', [UrlsController::class, 'index'])
->name('urls.index');

Route::post('/urls', [UrlsController::class, 'store'])
->name('urls.store');

Route::get('/urls/{id}', [UrlsController::class, 'show'])
->name('urls.show');

Route::post('urls/{id}/checks', [UrlsController::class, 'edit'])
->name('urls.checks');
