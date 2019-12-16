@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">Брони</span>
        </h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route("admin.reservations.create") }}" class="btn btn-primary btn-lg btn-warning">Добавить бронь</a>
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
                                <th>Номер</th>
                                <th>Дата заезда</th>
                                <th>Дата выезда</th>
                                <th>Дата создания брони</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($reservations->currentpage() - 1) * $reservations->perpage() }}
                                    </td>
                                    <td>
                                        <strong>{{ $reservation->user->name }}</strong>
                                    </td>
                                    <td>
                                        <p>{{ $reservation->room->classification }}</p>
                                    </td>
                                    <td>
                                        <strong>{{ $reservation["arrival"] }} </strong>
                                    </td>
                                    <td>
                                        <strong>{{ $reservation["departure"] }} </strong>
                                    </td>
                                    <td class="maw-320">
                                        <strong>{{ $reservation["created_at"] }} </strong>
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right dropdown">
                                            <button class="btn btn-link link-muted" aria-haspopup="true"
                                                    data-toggle="dropdown" type="button">
                                                <span class="icon icon-ellipsis-h icon-lg icon-fw"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ route("admin.reservations.edit", ["id_reservation" => $reservation["id"]]) }}">Изменить</a>
                                                </li>
                                                <li>
                                                    <a href="" class="delete_btn">
                                                        Удалить
                                                        <form class="hidden_form" method="post"
                                                              action="{{ route("admin.reservations.destroy", ["id_reservation" => $reservation["id"]]) }}">
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
                                {{ $reservations->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
