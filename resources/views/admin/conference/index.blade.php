@extends('layout')
@push('styles')
    <style>
        .create{
            position: absolute;
            right: 30px;
            bottom: 60px;
            border-radius: 70%;
            font-size: 24px;
            background-color: #999999;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(233, 30, 99, 0.4);
            background: linear-gradient(60deg, #ec407a, #d81b60);
            background-color: rgba(0, 0, 0, 0);
        }
    </style>
@endpush
@section('content')
    <div class="row">
        @foreach($conferences as $conference)
            <div class="col-md-4">
            <div class="card card-product" data-count="3">
                <div class="card-header card-header-image" data-header-animation="true">
                    <a href="#pablo">
                        <img class="img" src="{{$conference->img}}" style="width: 100%; height: 220px">
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-actions text-center">
                        <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <i class="material-icons">build</i> Fix Header!
                        </button>
                        <a href="{{route('conference.show', $conference->id)}}" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Посмотреть" aria-describedby="tooltip370414">
                            <i class="material-icons">art_track</i>
                        </a>
                        <a href="{{route('conference.edit', $conference->id)}}" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Редактировать">
                            <i class="material-icons">edit</i>
                        </a>
                        <form class="d-inline" action="{{route('conference.destroy', $conference->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Удалить">
                                <i class="material-icons">close</i>
                            </button>
                        </form>
                    </div>
                    <h4 class="card-title">
                        <a href="javascript:void (0)" class="text-truncate">{{$conference->title}}</a>
                    </h4>
                    <div class="card-description text-truncate">
                        {!! $conference->content !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <p class="card-category"><i class="material-icons">access_time</i> {{$conference->start}}</p>
                    </div>
                    <div class="stats">
                        <p class="card-category"><i class="material-icons">access_time</i> {{$conference->end}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a href="{{route('conference.create')}}" class="btn create">+<div class="ripple-container"></div></a>
@endsection
