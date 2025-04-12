{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'プロフィール作成'を埋め込む --}}
@section('title', 'プロフィール')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>{{ $user->name }}のプロフィール</h2>
            </div>
        </div>
        {{-- 投稿した口コミ --}}
        <div class="row">
            <h2>投稿した口コミ</h2>
            {{-- 新規投稿ボタン --}}
            <div class="row my-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('user.reviews.create') }}" class="btn btn-success">口コミの新規作成</a>
                </div>
            </div>
        </div>
         {{-- 投稿した口コミの一覧 --}}
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <td>
                                <div>
                                    <a href="{{ route('user.reviews') }}">投稿した口コミの一覧</a>
                                </div>
                            </td>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        {{-- 作成した計画 --}}
        <div class="row">
            <h2>作成した計画の一覧</h2>
        </div>
        {{-- 新規投稿ボタン --}}
        <div class="row my-3">
            <div class="col-md-12 text-right">
                <a href="{{ route('user.plan.create') }}" class="btn btn-success">旅行計画の新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <td>
                                <div>
                                    {{-- 作成した計画の一覧 --}}
                                    <a href="{{ route('user.plans') }}">作成した計画の一覧</a>
                                </div>
                            </td>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>フォロワー</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">ユーザーネーム</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->followed as $followed)
                                <tr>
                                    <td>{{ $followed->id }}</td>
                                    <td>{{ $followed->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
            <h2>フォロー中</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">ユーザーネーム</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->following as $following)
                                <tr>
                                    <td>{{ $following->id }}</td>
                                    <td><a href="{{ route('profile.user', ['id' => $following->id]) }}">{{ $following->name }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>グループの一覧</h2>
        </div>
        {{-- 新規投稿ボタン --}}
        <div class="row my-3">
            <div class="col-md-12 text-right">
                <a href="{{ route('group.create') }}" class="btn btn-success">グループの新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">グループ名</th>
                                <th width="20%">予定</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->plan?->title }}</td>
                                    <td>{{ $group->plan?->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="row">
            <h2>いいねした口コミ一覧</h2>
        </div>
        <div class="row">
            <table class="table table-dark">
                @if ($likedReviews->isNotEmpty())
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>ユーザー</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($likedReviews as $review)
                            <tr>
                                <td>{{ Str::limit($review->place, 50) }}</td>
                                <td>{{ $review->user->name }}</td>
                                <td><a href="{{ route('reviews.show', ['id' => $review->id]) }}">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="5">いいねした口コミはありません。</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <h2>送信したお問い合わせ一覧</h2>
        </div>
        <div class="row">
            <table class="table table-dark">
                @if ($contact->isNotEmpty())
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ Str::limit($contact->title, 50) }}</td>
                                <td>{{ $contact->content }}</td>
                                <td><a href="{{ route('contact', ['id' => $contact->id]) }}">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="5">送信したお問い合わせはありません。</td>
                    </tr>
                @endif
            </table>
        </div>
@endsection
