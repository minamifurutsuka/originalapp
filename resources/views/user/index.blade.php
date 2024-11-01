@extends('layouts.admin')

@section('title', 'ユーザー一覧')

@section('content')
<div class="container">
    <h2>ユーザー一覧</h2>
    <ul>
        @foreach ($users as $user)
            <li>
                {{ $user->name }}
                
                @if ($user->isFollowedBy(Auth::user()))
                    <!-- フォロー中の場合 -->
                    <form action="{{ route('users.unfollow', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}"> <!-- 隠しフィールドを追加 -->
                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>
                @else
                    <!-- フォローしていない場合 -->
                    <form action="{{ route('users.follow', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}"> <!-- 隠しフィールドを追加 -->
                        <button type="submit" class="btn btn-primary">フォロー</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection