<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;//登録ユーザーのDBを使用

class ProfileController extends Controller
{
    //
    public function profile()
    {
        $user = Auth::user();
        return view('profiles/profile', compact('user'));
    }
    
    //フォロー情報
    public function get_user($user_id){

        $user = User::with('following')->with('followed')->findOrFail($user_id);
        return response()->json($user);
    }
}
