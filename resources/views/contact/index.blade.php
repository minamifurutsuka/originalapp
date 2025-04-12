{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title','登録済みのお問い合わせ')

@section('content')
    <div class="container">
        <div class="row">
            <h2>お問い合わせの一覧</h2>
        </div>
        {{-- 新規投稿ボタン --}}
        <div class="row my-3">
            <div class="col-md-12 text-right">
                <a href="{{ route('contact.create') }}" class="btn btn-success">お問い合わせの新規作成</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="20%">内容</th>
                                <th width="20%">お問い合わせ日</th>
                                <th width="10%">詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <th>{{ $contact->id }}</th>
                                    <td>{{ Str::limit($contact->contact_title->title, 100) }}</td>
                                    <td>{{ Str::limit($contact->content, 250) }}</td>
                                    <td>{{ $contact->created_at->format('Y年m月d日 H:i') }}</td> <!-- お問い合わせ日を表示 -->
                                    <td><a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info">詳細</a></td> <!-- 詳細リンク -->
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