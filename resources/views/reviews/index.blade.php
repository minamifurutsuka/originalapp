{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title','登録済みの口コミ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>口コミの一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                {{-- ReviewController.phpのadd Action --}}
                <a href="{{ route('review.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('review.index') }}" method="get">
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
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <th>{{ $review->id }}</th>
                                    <td>{{ Str::limit($review->title, 100) }}</td>
                                    <td>{{ Str::limit($review->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('review.edit', ['id' => $review->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('review.delete', ['id' => $review->id]) }}">削除</a>
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

@foreach($reviews as $review)
{{$review->place}}
@endforeach