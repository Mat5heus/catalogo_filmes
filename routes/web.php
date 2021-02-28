<?php

use App\Http\Controllers\movieController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return redirect()->route('index');
});

Route::get('/home/{page?}', [movieController::class, 'index'])->name('index');

Route::get('/{page}/search', [movieController::class, 'search'])->name('search');

Route::get('/show/{id}', [movieController::class, 'show'])->name('show');

Route::get('/favorites', [movieController::class, 'favorites'])->name('favorites');
