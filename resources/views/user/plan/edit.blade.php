@extends('layouts.admin')
@section('title', '旅行の計画の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>旅行の計画の編集</h2>
                <form action="{{ route('user.plan.update') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title" value="{{ old('title', $plan_form->title) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">飛行機</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="plane" value="{{ old('plane', $plan_form->plane) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ホテル名</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="hotel" value="{{ old('hotel',$plan_form->hotel) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">レストラン</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="restaurant" value="{{ old('restaurant', $plan_form->restaurant) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">観光地</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="spot" value="{{ old('spot', $plan_form->spot) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="memo" rows="20">{{ old('memo',$plan_form->memo) }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $plan_form->id }}">
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                {{-- 編集履歴 --}}
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($plan_form->histories != NULL)
                                @foreach ($plan_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection