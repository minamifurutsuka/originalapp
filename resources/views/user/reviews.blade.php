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
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_reviews as $user_review)
                                <tr>
                                    <th>{{ $user_review->id }}</th>
                                    <td>{{ Str::limit($user_review->title, 100) }}</td>
                                    <td>
                                        <div>
                                            {{-- レビューの削除 --}}
                                            <a href="{{ route('user.review.delete', ['id' => $user_review->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection