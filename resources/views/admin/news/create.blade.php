@extends('layout')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
        .img-thumbnail img{
            width: 150px!important;
            height: 150px!important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">add</i>
                    </div>
                    <h4 class="card-title">Создать новость</h4>
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
                    <form method="post" action="{{route("news.store")}}"  id="js-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group bmd-form-group">
                            <label for="title" class="bmd-label-floating">Заголовок</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="subtitle" class="bmd-label-floating">Подзаголовок</label>
                            <input type="text" class="form-control" id="title" name="subtitle">
                        </div>
                        <div class="form-group bmd-form-group">
                            <select class="category w-100" id="category" name="category_id">
                                @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group bmd-form-group">
                            <select class="tags w-100" id="category" name="tags[]" multiple="multiple">
                                @if($tags->isNotEmpty())
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="content">Основной контент</label>
                            <textarea id="content" name="content">
                                <p>Контент вашей новости ....</p>
                            </textarea>
                        </div>
                        <div class="form-group bmd-form-group">
                            <p class="font-weight-bold">Предпросмотр новости</p>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                <span class="btn btn-outline-secondary btn-file">
                                  <span class="fileinput-new btn-rose">Выберите изображение</span>
                                  <span class="fileinput-exists">Изменить</span>
                                  <input type="file" name="thumbnail">
                                </span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Удалить</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group">
                            <p class="font-weight-bold">Изображение новости</p>
                            <div class="fileinput2 fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                <span class="btn btn-outline-secondary btn-file">
                                  <span class="fileinput-new btn-rose">Выберите изображение</span>
                                  <span class="fileinput-exists">Изменить</span>
                                  <input type="file" name="img">
                                </span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Удалить</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="title" class="bmd-label-floating">Подпись к фото</label>
                            <input type="text" class="form-control" id="title" name="img_description">
                        </div>
                        <div class="form-group bmd-form-group">
                            <div class="col-md-6">
                                <h4 class="title">Тип</h4>
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="trend">
                                        <span class="toggle"></span>
                                        Тренд
                                    </label>
                                </div>
                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" name="actual">
                                        <span class="toggle"></span>
                                        Актуальный
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="card-footer ">
                            <a href="{{route('news.index')}}" class="btn btn-fill btn-default">Назад</a>
                            <button type="submit" class="btn btn-fill btn-rose ml-auto">Создать</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.fileinput').fileinput();
            $('.fileinput2').fileinput();
            $('.category').select2();
            $(".tags").select2({
                tags: true
            });

            CKEDITOR.replace( 'content' );
        });
    </script>
@endpush
