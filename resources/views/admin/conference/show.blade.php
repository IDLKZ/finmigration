@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Общая информация
                    </h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <!--
                                      color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                  -->
                            <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#link110" role="tablist">
                                        <i class="material-icons">dashboard</i> Описание
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link111" role="tablist">
                                        <i class="material-icons">schedule</i> Время
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#request" role="tablist">
                                        <i class="material-icons">list</i> Заявки
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#confirmed" role="tablist">
                                        <i class="material-icons">list</i> Участники
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="link110">
                                    <h4><b>{{$conference->title}}</b></h4>
                                    {!! $conference->content !!}

                                    <strong>Преимущества</strong>
                                    {!! $conference->advantages !!}
                                </div>
                                <div class="tab-pane" id="link111">
                                    <b>ZoomID :</b> {{$conference->zoomId}}
                                    <br>
                                    <b>Пароль :</b> {{$conference->password}}
                                    <br>
                                    <b>Начало конференции :</b> {{$conference->start}}
                                    <br>
                                    <b>Конец конференции :</b> {{$conference->end}}
                                </div>
                                <div class="tab-pane" id="request">
                                        <div class="card">
                                            <div class="card-header card-header-rose card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">assignment</i>
                                                </div>
                                                <h4 class="card-title">Заявки</h4>

                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if($participants_request->isNotEmpty())
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
                                                            @foreach($participants_request as $participant)
                                                                <tr>
                                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                                    <td>{{$participant->name}}</td>
                                                                    <td>{{$participant->phone}}</td>
                                                                    <td>{{$participant->email}}</td>
                                                                    <td>{{$participant->conference->title}}</td>
                                                                    <td class="{{$participant->status == 1 ? 'bg-success' : "bg-warning"}}">{{$participant->status == 1 ? 'Потвержден' : "Участвует"}}</td>
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
                                                    @else
                                                        <h4 class="text-danger">Заявок еще нет</h4>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="tab-pane" id="confirmed">
                                        <div class="card">
                                            <div class="card-header card-header-rose card-header-icon">
                                                <div class="card-icon">
                                                    <i class="material-icons">assignment</i>
                                                </div>
                                                <h4 class="card-title">Участники</h4>

                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if($participants_confirmed->isNotEmpty())
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
                                                            @foreach($participants_confirmed as $participant)
                                                                <tr>
                                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                                    <td>{{$participant->name}}</td>
                                                                    <td>{{$participant->phone}}</td>
                                                                    <td>{{$participant->email}}</td>
                                                                    <td>{{$participant->conference->title}}</td>
                                                                    <td class="{{$participant->status == 1 ? 'bg-success' : "bg-warning"}}">{{$participant->status == 1 ? 'Потвержден' : "Участвует"}}</td>
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
                                                    @else
                                                        <h4 class="text-danger">Заявок еще нет</h4>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{route('conference.index')}}" class="btn btn-default">Назад</a>
        </div>
    </div>
@endsection
