{{-- layoutsの中のadmin.blade.phpを継承する --}}
@extends('layouts.admin')
{{-- admin.blade.phpを継承してから自分固有のパーツを定義する --}}
@section('title','グループ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>グループの一覧</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">グループ名</th>
                                <th width="20%">メンバー</th>
                                <th width="10%">編集</th>
                                <th width="10%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                           {{-- 多対多のリレーション --}}
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>
                                            @foreach($group->users as $user)
                                                {{ $user->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div>
                                                {{-- グループの編集--}}
                                                <a href="{{ route('group.edit', ['id' => $group->id]) }}">編集</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{-- グループの削除--}}
                                                <a href="{{ route('group.delete', ['id' => $group->id]) }}">削除</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection