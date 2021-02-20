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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{route('conference.index')}}" class="btn btn-default">Назад</a>
        </div>
    </div>
@endsection
