<?php

use App\Http\Controllers\moviesController;
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

Route::get('/home/{page?}', [moviesController::class, 'index'])->name('index');
Route::get('/', function() {
    return redirect()->route('index');
});
Route::any('/search', [moviesController::class, 'search'])->name('search');

Route::get('/show/{id}', [moviesController::class, 'show'])->name('show');

Route::get('/favorites', [moviesController::class, 'favorites'])->name('favorites');
