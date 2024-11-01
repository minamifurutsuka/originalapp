<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    //ユーザー一覧
    public function index()
    {
        // ログイン中のユーザー以外を取得
        $users = User::where('id', '!=', Auth::id())->get();

        return view('user.index', compact('users'));
    }
}
