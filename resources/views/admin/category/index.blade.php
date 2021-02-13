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
                    <h4 class="card-title">Список категорий</h4>
                    <a href="{{route('category.create')}}" class="btn btn-primary create">Создать<div class="ripple-container"></div></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Наименование</th>
                                <th class="text-right">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td>{{$category->title}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{route('category.edit', $category->id)}}" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="Редактировать">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form class="d-inline" action="{{route('category.destroy', $category->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" rel="tooltip" class="btn btn-danger btn-round" data-original-title="" title="Удалить">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>


                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
