@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">
                @if($update ?? false)
                    Изменить комнату
                @else
                    Добавить комнату
                @endif
            </span>
        </h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="demo-form-wrapper">
                @if (session('errors'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('errors')->first() }}
                    </div>
                @endif

                <form class="form form-horizontal" action="{{ $route }}" method="post">
                    @csrf
                    @if($update ?? false)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Классификация</label>
                        <div class="col-sm-9">
                            <select name="classification">
                                <option value="Apartment'">Apartment</option>
                                <option value="Business">Business</option>
                                <option value="Balcony">Balcony</option>
                                <option value="ExecutiveFloor">ExecutiveFloor</option>
                            </select>
                        </div>
                        <label class="col-sm-3 control-label">Количество комнат</label>
                        <div class="col-xs-4 col-sm-3">
                            <input id="roominess" class="form-control" name="roominess" value="{{ $room["roominess"] ?? '' }}"
                                   type="number">
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Цена</label>
                        <div class="col-sm-9">
                            <input id="price" class="form-control" name="price" value="{{ $room["price"] ?? '' }}"
                                   type="number">
                        </div>


                        <label class="col-sm-3 control-label" for="form-control-1">Описание</label>
                        <div class="col-xs-4 col-sm-3">
                            <textarea id="description" class="form-control" name="description"> {{ $room["description"] ?? '' }}</textarea>
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Ссылка на фотографию</label>
                        <div class="col-sm-9">
                            <input id="image" class="form-control" name="image" value="{{ $room["image"] ?? '' }}"
                                   type="text">
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1"></label>
                        <div class="col-sm-9 submitBtn" align="right">
                            <label class="btn btn-success file-upload-btn">
                                @if($update ?? false)
                                    Изменить
                                @else
                                    Добавить
                                @endif
                                <input class="file-upload-input" type="submit" multiple="">
                            </label>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
