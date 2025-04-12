{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title', 'ユーザーの投稿した口コミ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザーの投稿した口コミ一覧</h2>
        </div>
        <div class="row">
            {{ $review->id }}
            {{ Str::limit($review->title, 100) }}
                <div class="form-rating">
                @for($i = 0; $i < $review->rating; $i++)
                    <div class="star-yellow"> 
                      <i class="fa-solid fa-star"></i>  
                    </div>
                @endfor
                </div>
            {{ Str::limit($review->content, 250) }}
                @if ($review->photo_path)
                    <img src="{{ secure_asset('storage/image/' . $review->photo_path) }}">
                @endif
        </div>
    </div>
    
    {{-- プロフィールに戻るボタン--}}
    <div class="back-to-profile">
        <a href="{{ route('profile') }}" class="btn btn-primary">プロフィールに戻る</a>
    </div>
@endsection