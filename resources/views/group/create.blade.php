@extends('layouts.admin')
@section('title', 'グループの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>グループの新規作成</h2>
                <form action="{{ route('group.create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">グループ名</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="name" value="{{ old('place') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">フォロー中のユーザー一覧</label>
                        <div class="col-md-10">
                            @foreach($following_users as $following_user)
                                <input type="checkbox" name="selected_users[]" value="{{$following_user->id}}">{{ $following_user->name }}
                            @endforeach
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
    
    {{--プロフィールに戻るボタン--}}
    <div class="back-to-profile">
        <a href="{{ route('profile') }}" class="btn btn-primary">プロフィールに戻る</a>
    </div>
@endsection
