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
                    <h4 class="card-title">Заявки</h4>
                    <a href="{{route('participant.create')}}" class="btn btn-primary create">Создать<div class="ripple-container"></div></a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($participants->isNotEmpty())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>ФИО</th>
                                    <th>Телефон</th>
                                    <th>Почта</th>
                                    <th>Конференция</th>
                                    <th>Статус</th>
                                    <th class="text-right">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($participants as $participant)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$participant->name}}</td>
                                        <td>{{$participant->phone}}</td>
                                        <td>{{$participant->email}}</td>
                                        <td>{{$participant->conference->title}}</td>
                                        <td class="{{$participant->status == 1 ? 'bg-success' : "bg-warning"}}">{{$participant->status == 1 ? 'Потвержден' : "Не Участвует"}}</td>
                                        <td class="td-actions text-right">
                                            <a type="button" rel="tooltip" class="btn btn-info btn-round" href="{{route("participant.show",$participant->id)}}" data-original-title="" title="">
                                                <i class="material-icons">info</i>
                                            </a>
                                            <a href="{{route("participant.edit",$participant->id)}}" type="button" rel="tooltip" class="btn btn-success btn-round" data-original-title="" title="">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{route("participant.destroy",$participant->id)}}" method="post" class="d-inline">
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
                            {{$participants->links()}}
                        @else
                            <h4 class="text-danger">Заявок еще нет</h4>
                            <a class="btn btn-info text-white" href="{{route("participant.create")}}">
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
