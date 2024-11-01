<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;//フォロー機能

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

//プロフィール
use App\Http\Controllers\ProfileController;
Route::controller(ProfileController::class)->group(function() {
    Route::get('profile', 'profile')->middleware('auth');
    //プロフィール閲覧で使用するユーザー情報の取得
    Route::get('/profile/{id}',[ProfileController::class,'get_user']);
    //フォロー状態の確認
    Route::get('/follow/status/{id}',[FollowController::class,'check_following']);
    //フォロー付与
    Route::post('/follow/add',[FollowController::class,'following']);
    //フォロー解除
    Route::post('/follow/remove',[FollowController::class,'unfollowing']);
});

//プラン
use App\Http\Controllers\User\PlanController;
//URLの全ての頭にuserをつける時→prefix('user')
//nameの頭に全てuserをつける時->name('user.')
Route::controller(PlanController::class)->prefix('user')->name('user.')->middleware('auth')->group(function() {
    Route::get('plan/create', 'add');
    Route::post('plan/create','create')->name('plan.create');
    Route::get('plans', 'index')->name('plans');
    Route::get('plan/edit', 'edit')->name('plan.edit');
    Route::post('plan/edit', 'update')->name('plan.update');
    //計画を削除する
    Route::get('plan/delete', 'delete')->name('plan.delete');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//レビュー
use App\Http\Controllers\User\ReviewController;
Route::controller(ReviewController::class)->prefix('user')->name('user.')->middleware('auth')->group(function(){
    Route::get('review/create','add')->name('review.add');
    Route::post('review/create','create')->name('reviews.create');
    Route::get('review/edit','edit')->name('review.edit');
    Route::post('review/update','update')->name('review.update');
    Route::get('review/delete','delete')->name('review.delete');
    //ユーザーのレビューを表示する
    Route::get('reviews','index')->name('reviews');
});

//お問い合わせ
use App\Http\Controllers\ContactController;
Route::controller(ContactController::class)->middleware('auth')->group(function(){
    Route::get('contact/create','add')->name('contact.add');
    Route::post('contact/create','create')->name('contact.create');
    Route::get('contacts', 'index')->name('contact.index');
});

//グループ
use App\Http\Controllers\GroupController;
Route::controller(GroupController::class)->middleware('auth')->group(function(){
    Route::get('group/create','add')->name('group.add');
    Route::post('group/create','create')->name('group.create');
    Route::get('groups', 'index')->name('group.index');
    Route::get('group/edit','edit')->name('group.edit');
    Route::post('group/update','update')->name('group.update');
    Route::get('group/delete','delete')->name('group.delete');
});

use App\Http\Controllers\ReviewController as PublicReviewController;
Route::get('reviews', [PublicReviewController::class, 'index'])->name('reviews.index');

//ユーザー一覧
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController as UserFollowController; // 別名でインポート
Route::get('users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::post('users/{user}/follow', [FollowController::class, 'following'])->name('users.follow');
Route::post('users/{user}/unfollow', [FollowController::class, 'unfollowing'])->name('users.unfollow');