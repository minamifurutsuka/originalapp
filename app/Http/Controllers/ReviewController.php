<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Review;
use App\Http\Controllers\cond_title;

class ReviewController extends Controller
{
    //
    public function add()
    {
        return view('reviews.create');
    }
    
     // 
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Review::$rules);
        
        $review = new Review;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $review->photo_path = basename($path);
        } else {
            $review->photo_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        $review->user_id = Auth::id();
        
        // データベースに保存する
        $review->fill($form);
        $review->save();
        
        // reviews/createにリダイレクトする
        return redirect('reviews/create');
    }
    
    //口コミの一覧表示
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if (cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Review::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのレビューを取得する
            $posts = Review::all();
        }
        $reviews = Review::all();
        return view('reviews.index', ['reviews' => $reviews,'cond_title' => $cond_title]);
    }
}
