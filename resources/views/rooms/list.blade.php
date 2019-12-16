@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">Комнаты</span>
        </h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route("admin.rooms.create") }}" class="btn btn-primary btn-lg btn-warning">Добавить комнату</a>
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
                                <th>Тип</th>
                                <th>Число комнат</th>
                                <th>Цена</th>
                                <th>Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($rooms->currentpage() - 1) * $rooms->perpage() }}
                                    </td>
                                    <td>
                                        <strong>{{ $room['classification'] }}</strong>
                                    </td>
                                    <td>
                                        <p>{{ $room->roominess }}</p>
                                    </td>
                                    <td>
                                        <strong>{{ $room->price }} </strong>
                                    </td>
                                    <td>
                                        <strong>{{ $room->description }} </strong>
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right dropdown">
                                            <button class="btn btn-link link-muted" aria-haspopup="true"
                                                    data-toggle="dropdown" type="button">
                                                <span class="icon icon-ellipsis-h icon-lg icon-fw"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route("admin.rooms.edit", ["id" => $room["id"]]) }}">Изменить</a>
                                                </li>
                                                <li>
                                                    <a href="" class="delete_btn">
                                                        Удалить
                                                        <form class="hidden_form" method="post"
                                                              action="{{ route("admin.rooms.destroy", ["id" => $room["id"]]) }}">
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
                                {{ $rooms->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
