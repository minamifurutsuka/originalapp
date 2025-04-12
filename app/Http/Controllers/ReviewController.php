<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    //すべての口コミの一覧表示
    public function index(Request $request)
    {
        //$cond_titleに値を代入する→$requestの中のcond_titleの値を$cond_titleに代入する
        $cond_title = $request->input('cond_title', ''); //検索条件の初期値を空にする
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            //LIKEは部分一致検索
            $reviews = Review::where('title', 'LIKE', '%' . $cond_title . '%')->get(); 
        } else {
            // それ以外はすべてのレビューを取得する
            $reviews = Review::all();
        }
        
        return view('reviews.index', ['reviews' => $reviews,'cond_title' => $cond_title]);
    }
    
    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
    }
}
