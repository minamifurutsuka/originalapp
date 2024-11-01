@extends('layouts.admin')
@section('title', '旅行の計画の新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>旅行の計画の新規作成</h2>
                <form action="{{ route('user.plan.create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">日付</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">飛行機</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="plane" value="{{ old('plane') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ホテル名</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="hotel" value="{{ old('hotel') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">レストラン</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="restaurant" value="{{ old('restaurant') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">観光地</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="spot" value="{{ old('spot') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="memo" rows="20">{{ old('memo') }}</textarea>
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
