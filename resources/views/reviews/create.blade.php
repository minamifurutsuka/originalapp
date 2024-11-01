@extends('layouts.admin')
@section('title', '口コミの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>口コミの新規作成</h2>
                <form action="{{ route('user.reviews.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">場所</label>
                        <div class="col-md-10">
                            {{-- name＝の後はmigrationのカラム名と合わせる --}}
                            <input type="text" class="form-control" name="place" value="{{ old('place') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">評価</label>
                        <div class="col-md-10">
                            <div class="form-rating">
                                <input class="form-rating__input" id="star5" name="rating" type="radio" value="5">
                                <label class="form-rating__label" for="star5"><i class="fa-solid fa-star"></i></label>
                        
                                <input class="form-rating__input" id="star4" name="rating" type="radio" value="4">
                                <label class="form-rating__label" for="star4"><i class="fa-solid fa-star"></i></label>
                        
                                <input class="form-rating__input" id="star3" name="rating" type="radio" value="3">
                                <label class="form-rating__label" for="star3"><i class="fa-solid fa-star"></i></label>
                        
                                <input class="form-rating__input" id="star2" name="rating" type="radio" value="2">
                                <label class="form-rating__label" for="star2"><i class="fa-solid fa-star"></i></label>
                        
                                <input class="form-rating__input" id="star1" name="rating" type="radio" value="1">
                                <label class="form-rating__label" for="star1"><i class="fa-solid fa-star"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">内容</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="content" rows="20">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
