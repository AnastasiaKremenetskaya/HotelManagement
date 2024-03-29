@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">
                @if($update ?? false)
                    Изменить сотрудника
                @else
                    Добавить сотрудника
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
                        <label class="col-sm-3 control-label" for="form-control-1">Имя</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control" name="name" value="{{ $user["name"] ?? '' }}"
                                   type="text">
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Должность</label>
                        <div class="col-xs-4 col-sm-3">
                            <select class="custom-select" name="role_id" id="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Дата рождения</label>
                        <div class="col-sm-9">
                            <input id="date_of_birth" class="form-control" name="date_of_birth" value="{{ $user["date_of_birth"] ?? '' }}"
                                   type="date">
                        </div>

                        <label class="col-sm-3 control-label">Зарплата</label>
                        <div class="col-xs-4 col-sm-3">
                            <input id="salary" class="form-control" name="salary" value="{{ $user["salary"] ?? '' }}"
                                   type="number">
                        </div>

                        <label class="col-sm-3 control-label" for="form-control-1">Номер телефона</label>
                        <div class="col-sm-9">
                            <input id="phone" class="form-control" name="phone" value="{{ $user["phone"] ?? '' }}"
                                   type="tel">
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
