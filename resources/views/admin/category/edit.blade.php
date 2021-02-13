@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{route('category.update', $category->id)}}" id="js-form">
                @method('put')
                @csrf
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">category</i>
                        </div>
                        <h4 class="card-title">Изменить категорию</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="exampleTitle" class="bmd-label-floating">Наименование</label>
                            <input type="text" name="title" value="{{$category->title}}" class="form-control" id="exampleTitle">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('category.index')}}" class="btn btn-fill btn-default">Назад</a>
                        <button type="submit" class="btn btn-fill btn-rose ml-auto">Обновить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
