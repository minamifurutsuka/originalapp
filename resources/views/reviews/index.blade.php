{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title','登録済みの口コミ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>すべての口コミの一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('user.reviews') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">場所</th>
                                <th width="10%">評価</th>
                                <th width="20%">内容</th>
                                <th width="10%">画像</th>
                                <th width="30%">いいね</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- すべての口コミを表示 --}}
                            @foreach($reviews as $review)
                                <tr>
                                    <th>{{ $review->id }}</th>
                                    <td>{{ Str::limit($review->place, 100) }}</td>
                                    <td>
                                        <div class="form-rating">
                                            @for($i = 0; $i < $review->rating; $i++)
                                                <div class="star-yellow"> 
                                                    <i class="fa-solid fa-star"></i>  
                                                </div>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($review->content, 250) }}</td>
                                    <td>
                                        @if ($review->photo_path)
                                            <img src="{{ secure_asset('storage/image/' . $review->photo_path) }}" alt="口コミ画像">
                                        @endif
                                    </td>
                                    <td>
                                        {{-- いいねボタン --}}
                                        <form action="{{ $review->is_liked(Auth::user()) ? route('like.destroy', $review->id) : route('like.store', $review->id) }}" method="POST">
                                            @csrf
                                            @if($review->is_liked(Auth::user()))
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">いいね解除</button>
                                            @else
                                                <button type="submit" class="btn btn-primary">いいね</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{--プロフィールに戻るボタン--}}
    <div class="back-to-profile">
        <a href="{{ route('profile') }}" class="btn btn-primary">プロフィールに戻る</a>
    </div>
@endsection