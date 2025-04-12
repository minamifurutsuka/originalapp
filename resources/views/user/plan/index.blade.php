{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title','登録済みの旅行の計画一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>旅行の計画の一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                {{-- 旅行の計画の検索 --}}
                <form action="{{ route('user.plans') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            {{-- input typeのtextは１行のみ入力できる --}}
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
                                <th width="20%">タイトル</th>
                                <th width="10%">日付</th>
                                <th width="30%">メモ</th>
                                <th width="10%">編集</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- $plans が null または空でないかをチェック --}}
                            @if(!empty($plans) && $plans->count() > 0)
                                @foreach($plans as $plan)
                                    <tr>
                                        <th>{{ $plan->id }}</th>
                                        <td>{{ Str::limit($plan->title, 100) }}</td>
                                        <td>{{ Str::limit($plan->date, 100) }}</td>
                                        <td>{{ Str::limit($plan->memo, 250) }}</td>
                                        <td>
                                            <div>
                                                {{-- 計画の編集--}}
                                                <a href="{{ route('user.plan.edit', ['id' => $plan->id]) }}">編集</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{-- 計画の削除--}}
                                                <a href="{{ route('user.plan.delete', ['id' => $plan->id]) }}">削除</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">登録された旅行の計画がありません。</td>
                                </tr>
                            @endif
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