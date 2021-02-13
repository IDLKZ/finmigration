@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info</i>
                    </div>
                    <h4 class="card-title">Информация о теге {{$tag->title}}</h4>
                </div>
                <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="title" class="bmd-label-floating">Наименование</label>
                            <input type="text" class="form-control" id="title" value="{{$tag->title}}" disabled>
                        </div>
                    <div class="form-group bmd-form-group">
                        <label for="title" class="bmd-label-floating">Ссылка</label>
                        <input type="text" class="form-control" id="title" value="{{$tag->alias}}" disabled>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
