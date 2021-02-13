@extends('layout')
@push('styles')
    <style>
        .create{
            border-radius: 3px;
            background-color: #999999;
            padding: 15px;
            margin-top: -60px;
            margin-right: 15px;
            float: right;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(233, 30, 99, 0.4);
            background: linear-gradient(60deg, #ec407a, #d81b60);
            background-color: rgba(0, 0, 0, 0);
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Теги</h4>
                    <a href="{{route('tag.create')}}" class="btn btn-primary create">Создать<div class="ripple-container"></div></a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($tags->isNotEmpty())
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Тег</th>
                                <th class="text-right">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$tag->title}}</td>
                                <td class="td-actions text-right">
                                    <a type="button" rel="tooltip" class="btn btn-info btn-round" href="{{route("tag.show",$tag->id)}}" data-original-title="" title="">
                                        <i class="material-icons">info</i>
                                    </a>
                                    <a href="{{route("tag.edit",$tag->id)}}" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form action="{{route("tag.destroy",$tag->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{$tags->links()}}
                        @else
                        <h4 class="text-danger">Тегов еще нет</h4>
                            <a class="btn btn-info text-white" href="{{route("tag.create")}}">
                                <i class="material-icons">add</i>
                                Создать
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
