@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">
                @if($update ?? false)
                    Изменить инвентарь
                @else
                    Добавить инвентарь
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
                        <label class="col-sm-3 control-label" for="form-control-1">Название</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="name" value="{{ $inventory["name"] ?? '' }}"
                                   type="text">
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Комната</label>
                        <div class="col-xs-4 col-sm-3">
                            <select class="custom-select" name="room_id" id="role_id">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->id }}</option>
                                @endforeach
                            </select>
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
