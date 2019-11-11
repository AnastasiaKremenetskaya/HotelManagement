@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">Сотрудники</span>
        </h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route("admin.staff.create") }}" class="btn btn-primary btn-lg btn-warning">Добавить сотрудника</a>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="demo-dynamic-tables-1" class="table table-middle nowrap">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Имя</th>
                                <th>Должность</th>
                                <th>Зарплата</th>
                                <th>Телефон</th>
                                <th>Дата рождения</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staff as $one_staff)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($staff->currentpage() - 1) * $staff->perpage() }}
                                    </td>
                                    <td>
                                        <strong>{{ $one_staff['name'] }}</strong>
                                    </td>
                                    <td>
                                        <p>{{ $one_staff->role->name }}</p>
                                    </td>
                                    <td>
                                        <strong>{{ $one_staff["salary"] }} </strong>
                                    </td>
                                    <td>
                                        <strong>{{ $one_staff["phone"] }} </strong>
                                    </td>
                                    <td class="maw-320">
                                        <strong>{{ $one_staff["date_of_birth"] }} </strong>
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right dropdown">
                                            <button class="btn btn-link link-muted" aria-haspopup="true"
                                                    data-toggle="dropdown" type="button">
                                                <span class="icon icon-ellipsis-h icon-lg icon-fw"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route("admin.staff.edit", ["id" => $staff["id"]]) }}">Изменить</a>
                                                </li>
                                                <li>
                                                    <a href="" class="delete_btn">
                                                        Удалить
                                                        <form class="hidden_form" method="post"
                                                              action="{{ route("admin.staff.destroy", ["id" => $staff["id"]]) }}">
                                                            @csrf
                                                            @method("DELETE")
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dataTables_paginate paging_simple_numbers" id="demo-dynamic-tables-2_paginate">
                                {{ $staff->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
