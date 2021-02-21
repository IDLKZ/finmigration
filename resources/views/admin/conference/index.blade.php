@extends('layout')
@push('styles')
    <style>

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            text-align: center;
            position: sticky;
            right: 30px;
            bottom: 60px;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            z-index: 20;
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
                    <h4 class="card-title text-wrap">
                        <a href="javascript:void (0)" class="text-truncate" style="word-break: break-all">{{$conference->title}}</a>
                    </h4>
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
    {!! $conferences->links() !!}
    <a href="{{route('conference.create')}}" type="button" class="btn btn-danger btn-circle btn-xl">+</a>
@endsection
