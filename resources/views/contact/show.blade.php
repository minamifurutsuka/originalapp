@extends('layouts.admin')

@section('title', 'お問い合わせ詳細')

@section('content')
    <div class="container">
        <div class="row">
            <h2>お問い合わせ詳細</h2>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $contact->id }}</td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td>{{ $contact->contact_title->title }}</td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>{{ $contact->content }}</td>
                    </tr>
                    <tr>
                        <th>作成日</th>
                        <td>{{ $contact->created_at->format('Y年m月d日 H:i') }}</td>
                    </tr>
                </table>
                <div>
                    <a href="{{ route('contact.index') }}" class="btn btn-secondary">お問い合わせ一覧へ戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection