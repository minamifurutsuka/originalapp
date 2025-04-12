<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;//フォロー機能
use App\Http\Controllers\ProfileController; //プロフィール
use App\Http\Controllers\User\PlanController; //プラン
use App\Http\Controllers\User\ReviewController; //レビュー
use App\Http\Controllers\ContactController; //お問い合わせ
use App\Http\Controllers\GroupController; //グループ
use App\Http\Controllers\ReviewController as PublicReviewController;
use App\Http\Controllers\UserController; //ユーザー一覧
use App\Http\Controllers\FollowController as UserFollowController; // 別名でインポート
use App\Http\Controllers\LikeController; //いいね機能

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

// プロフィール関連
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('profile', 'profile')->name('profile'); // プロフィール画面
    Route::get('profile/{id}', 'get_user')->name('profile.user'); // 特定ユーザーのプロフィール情報取得
});

// フォロー機能関連
Route::middleware('auth')->controller(FollowController::class)->group(function () {
    Route::get('follow/status/{id}', 'check_following')->name('follow.status'); // フォロー状態の確認
    Route::post('follow/add', 'following')->name('follow.add'); // フォロー付与
    Route::post('follow/remove', 'unfollowing')->name('follow.remove'); // フォロー解除
});

//プラン
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
Route::controller(ContactController::class)->middleware('auth')->group(function(){
    Route::get('contact/create','add')->name('contact.add');
    Route::post('contact/create','create')->name('contact.create');
    Route::get('contacts', 'index')->name('contact.index');
    Route::get('contact/{id}', [ContactController::class, 'show'])->name('contact.show');
});

//グループ
Route::controller(GroupController::class)->middleware('auth')->group(function(){
    Route::get('group/create','add')->name('group.add');
    Route::post('group/create','create')->name('group.create');
    Route::get('groups', 'index')->name('group.index');
    Route::get('group/edit/{id}', 'edit')->name('group.edit'); // IDを受け取る
    Route::post('group/update','update')->name('group.update');
    Route::get('group/delete','delete')->name('group.delete');
    
});

Route::get('reviews', [PublicReviewController::class, 'index'])->name('reviews.index');
Route::get('reviews/{id}', [PublicReviewController::class, 'show'])->name('reviews.show');

//ユーザー一覧
Route::get('users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::post('users/{user}/follow', [FollowController::class, 'following'])->name('users.follow');
Route::post('users/{user}/unfollow', [FollowController::class, 'unfollowing'])->name('users.unfollow');

//いいね機能
Route::middleware('auth')->group(function () {
    Route::post('/reviews/{review}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/reviews/{review}/like', [LikeController::class, 'destroy'])->name('like.destroy');
});

//いいね表示
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
});