@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info</i>
                    </div>
                    <h4 class="card-title">Информация о новости {{$news->title}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card px-4 py-4">
                <h2 class="card-title">{{$news->title}}</h2>
                    <img src="{{$news->img}}">
                <h4 class="card-category">{{$news->subtitle}}</h4>
                <div class="card-description">
                    {!! $news->content !!}
                </div>
            </div>
            <a class="btn btn-default" href="{{route("news.index")}}">Назад</a>
        </div>

    </div>
@endsection
