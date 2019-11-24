@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">Доп услуги</span>
        </h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route("admin.extra_services.create") }}" class="btn btn-primary btn-lg btn-warning">Добавить доп услгу</a>
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
                                <th>Название доп услуги</th>
                                <th>Цена доп услуги</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($extra_services as $extra_service)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($extra_services->currentpage() - 1) * $extra_services->perpage() }}
                                    </td>
                                    <td>
                                        <strong>{{ $extra_service["name"] }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $extra_service["price"] }}</strong>
                                    </td>
                                    <td class="maw-320">
                                        {{ $extra_service["created_at"] }}
                                    </td>
                                    <td>
                                        {{ $extra_service["updated_at"] }}
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right dropdown">
                                            <button class="btn btn-link link-muted" aria-haspopup="true"
                                                    data-toggle="dropdown" type="button">
                                                <span class="icon icon-ellipsis-h icon-lg icon-fw"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route("admin.extra_services.edit", ["id_extra_service" => $extra_service["id"]]) }}">Изменить</a>
                                                </li>
                                                <li>
                                                    <a href="" class="delete_btn">
                                                        Удалить
                                                        <form class="hidden_form" method="post"
                                                              action="{{ route("admin.extra_services.destroy", ["id_extra_service" => $extra_service["id"]]) }}">
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
                                {{ $extra_services->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
