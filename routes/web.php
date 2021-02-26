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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', moviesController::class);
Route::any('/search', [moviesController::class, 'search'])->name('search');
Route::resource('/catalogo', moviesController::class)->only(
    'show'
);
Route::get('/favoritos', [moviesController::class, 'favoritos'])->name('favoritos');
