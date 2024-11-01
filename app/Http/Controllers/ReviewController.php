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
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $reviews = Review::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのレビューを取得する
            $reviews = Review::all();
        }
        $reviews = Review::all();
        return view('reviews.index', ['reviews' => $reviews,'cond_title' => $cond_title]);
    }
    
}
