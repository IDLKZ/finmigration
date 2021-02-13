@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('conference.store')}}" id="js-form" enctype="multipart/form-data">
                @csrf
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">ondemand_video</i>
                        </div>
                        <h4 class="card-title">Создать конференцию</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="exampleTitle" class="bmd-label-floating">Наименование</label>
                            <input type="text" name="title" class="form-control" id="exampleTitle">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="exampleContent">Описание</label>
                            <textarea name="content" id="exampleContent"></textarea>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="exampleAdv">Преимущества</label>
                            <textarea name="advantages" id="exampleAdv"></textarea>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="exampleZoom" class="bmd-label-floating">Идентификационный номер конференции Zoom</label>
                            <input type="text" name="zoomId" class="form-control" id="exampleZoom">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="examplePassword" class="bmd-label-floating">Пароль конференции</label>
                            <input type="text" name="password" class="form-control" id="examplePassword">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="examplePrice" class="bmd-label-floating">Цена</label>
                            <input type="text" name="price" class="form-control" id="examplePrice">
                        </div>
                        <div class="form-group bmd-form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card ">
                                        <div class="card-header card-header-rose card-header-text">
                                            <div class="card-icon">
                                                <i class="material-icons">today</i>
                                            </div>
                                            <h4 class="card-title">Начало конференции</h4>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form-group bmd-form-group is-filled">
                                                <input type="text" name="start" class="form-control datetimepicker" value="01/01/2021">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card ">
                                        <div class="card-header card-header-rose card-header-text">
                                            <div class="card-icon">
                                                <i class="material-icons">today</i>
                                            </div>
                                            <h4 class="card-title">Конец конференции</h4>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form-group bmd-form-group is-filled">
                                                <input type="text" name="end" class="form-control datetimepicker" value="01/01/2021">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group">
                            <div class="col-md-4 col-sm-4">
                                <h4 class="title">Выберите изображения</h4>
                                <div class="fileinput text-center fileinput-exists" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="/img/image_placeholder.jpg" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                                    <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Выбрать изображения</span>
                            <span class="fileinput-exists">Изменить</span>
                            <input type="hidden" value="" name=""><input type="file" name="img">
                          <div class="ripple-container"></div></span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Удалить<div class="ripple-container"><div class="ripple-decorator ripple-on ripple-out" style="left: 59.4px; top: 12.6167px; background-color: rgb(255, 255, 255); transform: scale(15.5063);"></div></div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('conference.index')}}" class="btn btn-fill btn-default">Назад</a>
                        <button type="submit" class="btn btn-fill btn-rose ml-auto">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('js/jasny-bootstrap.min.js')}}"></script>
    <script>
        CKEDITOR.replace( 'content' );
        CKEDITOR.replace( 'advantages' );
        $(document).ready(function() {
            // initialise Datetimepicker and Sliders
            md.initFormExtendedDatetimepickers();
        });
    </script>
@endpush
