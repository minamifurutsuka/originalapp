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
                                <th width="20%">グループ名</th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 多対多のリレーション --}}
                            @foreach($groups as $group)
                                 {{ $group->id }}
                                  @foreach($group->users as $user)
                                    {{ $user->name }}
                                  @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection