<?php

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProfileController;
Route::controller(ProfileController::class)->group(function() {
    Route::get('profile', 'profile')->middleware('auth');
});

use App\Http\Controllers\Admin\PlanController;
Route::controller(PlanController::class)->prefix('admin')->group(function() {
    Route::get('plan/create', 'add')->middleware('auth');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ReviewController;
Route::controller(ReviewController::class)->middleware('auth')->group(function(){
    Route::get('reviews/create','add')->name('reviews.add');
    Route::post('reviews/create','create')->name('reviews.create');
    Route::get('reviews', 'index')->name('reviews.index');
});