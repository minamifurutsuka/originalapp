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
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <td>
                                <div>
                                    {{-- 投稿した口コミの一覧 --}}
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
            <h2>フォロー中のユーザー</h2>
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
                            {{-- @foreach($following as $followings)
                                    <th>{{$user}}</th>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
