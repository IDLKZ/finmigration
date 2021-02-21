@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">add</i>
                    </div>
                    <h4 class="card-title">Создать заявку</h4>
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
                    <form method="post" action="{{route("participant.store")}}"  id="js-form">
                        @csrf
                        <div class="form-group bmd-form-group">
                            <select class="form-control" name="conference_id" id="conference">
                                @foreach($conferences as $conference)
                                    <option value="{{$conference->id}}">{{$conference->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group bmd-form-group">
                            <label for="title" class="bmd-label-floating">ФИО</label>
                            <input type="text" class="form-control" id="title" name="name">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="phone" class="bmd-label-floating">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="email" class="bmd-label-floating">Почта</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group bmd-form-group">
                            <div class="col-md-6">
                                <h4 class="title">Потвержден</h4>
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="status">
                                        <span class="toggle"></span>
                                        Заявка потверждена
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <a href="{{route('participant.index')}}" class="btn btn-fill btn-default">Назад</a>
                            <button type="submit" class="btn btn-fill btn-rose ml-auto">Создать</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
