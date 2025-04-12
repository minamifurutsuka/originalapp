<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // プロフィール画面を表示
    public function profile()
    {
        $user = Auth::user(); // ログイン中のユーザー
        $likedReviews = $user->likedReviews()->with('user')->get(); // いいねした口コミ
    
        // ビューに必要なデータを渡す
        return view('profiles.profile', compact('user', 'likedReviews'));
    }
    
    // フォロー情報の取得 
    public function get_user($id)
    {
        $user = User::findOrFail($id);
        return view('profiles.profile',compact('user'));
    }
}