<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; //Reviewクラスをインポート

class LikeController extends Controller
{
    //口コミにいいねを保存する処理
    public function store(Request $request, Review $review)
    {
        $user = $request->user();

        // すでにいいねしているか確認
        if (!$user->likedReviews()->where('review_id', $review->id)->exists()) {
            $user->likedReviews()->attach($review->id);
        }

        return back()->with('success', 'いいねしました！');
    }

    //リソースを削除する処理
    public function destroy(Request $request, Review $review)
    {
        $user = $request->user();

        // いいねを解除
        $user->likedReviews()->detach($review->id);

        return back()->with('success', 'いいねを解除しました！');
    }
}