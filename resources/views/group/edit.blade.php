@extends('layouts.admin')
@section('title', 'グループの編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>グループの編集</h2>
            <form action="{{ route('group.update', ['id' => $group->id]) }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="name" value="{{ old('name', $group->name) }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>メンバー</label>
                    <div>
                        @foreach($following_users as $user)
                            <div>
                                <input type="checkbox" name="selected_user[]" value="{{ $user->id }}" 
                                       @if($group->users->contains($user)) checked @endif>
                                {{ $user->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @csrf
                <input type="hidden" name="id" value="{{ $group->id }}">
                <input type="submit" class="btn btn-primary" value="更新">
            </form>
            {{-- 編集履歴 --}}
            <div class="row mt-5">
                <div class="col-md-4 mx-auto">
                    <h2>編集履歴</h2>
                    <ul class="list-group">
                        @if ($group->histories != NULL)
                            @foreach ($group->histories as $history)
                                <li class="list-group-item">{{ $history->edited_at }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{--プロフィールに戻るボタン--}}
    <div class="back-to-profile">
        <a href="{{ route('profile') }}" class="btn btn-primary">プロフィールに戻る</a>
    </div>
@endsection