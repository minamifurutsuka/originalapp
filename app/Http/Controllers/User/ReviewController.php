<?php
//ユーザーのレビューは自分だけのレビューが見れる

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Review;

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
        return redirect('user/review/create');
    }
    
    public function index()
    {
        // 自分だけの口コミの一覧表示
        $cond_title = '';
        $user_reviews = Auth::user()->reviews; // ユーザーのレビューを取得
        return view('user.reviews', ['user_reviews' => $user_reviews, 'cond_title' => $cond_title]);
    }
    
    
    public function delete(Request $request)
    {
        // 該当するReview Modelを取得
        $review = Review::find($request->id);
    
        // レビューが見つからない場合
        if (!$review) {
            return redirect('user/reviews')->with('error', 'レビューが見つかりませんでした。');
        }
    
        // 削除する
        $review->delete();
    
        return redirect('user/reviews')->with('success', 'レビューが削除されました。');
    }
}
