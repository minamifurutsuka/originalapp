<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;//Followモデルをインポート
use Illuminate\Support\Facades\Auth; // Authファサードを読み込む
use App\Models\User; // Userモデルをインポート

class FollowController extends Controller
{
    //フォローしているかどうかの状態確認
    public function check_following($id){

        //自分がフォローしているかどうか検索
        $check = Follow::where('following', Auth::id() )->where('followed', $id);

        if($check->count() == 0){
            //フォローしていない場合
            return response()->json(['status' => false]);
        }
        
        else{
            //フォローしている場合
            return response()->json(['status' => true]); 
        }
            
        return view('profile', ['following' => $following,'cond_title' => $cond_title]);
    }

    //フォローする(中間テーブルをインサート)
    public function following(Request $request,User $user){

        //自分がフォローしているかどうか検索
        $check = Follow::where('following', Auth::id())->where('followed', $user->user_id)->first();

        //検索結果が0(まだフォローしていない)場合のみフォローする
        if(!$check){
            $follow = new Follow;
            $follow->following = Auth::id();
            $follow->followed = $user->id; // ここでuser->idを使用
            $follow->save();
        }
        
        return redirect('users');
    }

    //フォローを外す
    public function unfollowing(Request $request,User $user){
        //Log::debug(Auth::id());
        //Log::debug($user)
        //削除対象のレコードを検索して削除
        Follow::where('following', Auth::id())->where('followed', $user->id)->delete();
        
        return redirect('users');
    }
}
