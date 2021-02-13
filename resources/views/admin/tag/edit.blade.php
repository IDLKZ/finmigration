@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">edit</i>
                    </div>
                    <h4 class="card-title">Изменить тег {{$tag->title}}</h4>
                </div>
                <div class="card-body ">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-rose">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>
                                    {{$error}}
                                </span>
                            </div>

                        @endforeach
                    @endif
                    <form method="post" action="{{route("tag.update",$tag->id)}}" id="js-form">
                        @csrf
                        @method("PUT")
                        <div class="form-group bmd-form-group">
                            <label for="title" class="bmd-label-floating">Наименование</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$tag->title}}">
                        </div>
                        <div class="card-footer ">
                            <a href="{{route('tag.index')}}" class="btn btn-fill btn-default">Назад</a>
                            <button type="submit" class="btn btn-fill btn-rose ml-auto">Изменить</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
