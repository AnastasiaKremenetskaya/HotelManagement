@extends('index')
@section('title', 'Rooms')

@section('content')
    <div class="container my-5">
        <div class="row">

            @foreach ($rooms as $room)
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <div style="background-image:url('{{ $room->image }}');height:300px;background-size:cover;" class="img-fluid" alt="Front of hotel"></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->roominess }}</h5>
                            <p class="card-text">{{ $room->description }}</p>
                            <h5 class="card-title">{{ $room->price }}</h5>
                            <a href="/dashboard/reservations/create/{{ $room->id }}" class="btn btn-primary">Забронировать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
