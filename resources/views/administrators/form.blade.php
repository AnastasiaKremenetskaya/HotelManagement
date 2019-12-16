@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">
                @if($update ?? false)
                    Изменить администратора
                @else
                    Добавить администратора
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
                        <label class="col-sm-3 control-label" for="form-control-1">Укажите работника</label>
                        <div class="col-xs-4 col-sm-3">
                            <select class="custom-select" name="staff_id" id="staff_id">
                                @foreach($staff as $one_staff)
                                    <option value="{{ $one_staff->id }}">{{ $one_staff->name }}</option>
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
