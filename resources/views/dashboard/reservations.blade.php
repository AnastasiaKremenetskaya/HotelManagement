@extends('index')
@section('title', 'Reservations')

@section('content')
    <div class="container mt-5">
        <h2>Ваши брони</h2>
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">Прибытие</th>
                <th scope="col">Выезд</th>
                <th scope="col">Тип</th>
                <th scope="col">Гости</th>
                <th scope="col">Цена</th>
                <th scope="col">Изменить</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->arrival }}</td>
                    <td>{{ $reservation->departure }}</td>
                    <td>{{ $reservation->room['classification'] }}</td>
                    <td>{{ $reservation->num_of_guests }}</td>
                    <td>${{ $reservation->room['price'] }}</td>
                    <td><a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-success">Редактировать</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        @if(!empty(Session::get('success')))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
        @endif
        @if(!empty(Session::get('error')))
            <div class="alert alert-danger"> {{ Session::get('error') }}</div>
        @endif
    </div>

@endsection
