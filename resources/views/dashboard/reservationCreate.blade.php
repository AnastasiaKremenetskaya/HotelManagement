@extends('index')
@section('title', 'Create reservation')

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">Book your stay now at the most wonderful hotel!</p>
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="room">Room Type</label>
                                <select class="form-control" name="room_id">
                                    @foreach ($roomInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->classification }} -
                                            ${{ $option->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="guests">Number of guests</label>
                                <input class="form-control" name="num_of_guests" placeholder="1" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="arrival">Arrival</label>
                                <input type="date" class="form-control" name="arrival" placeholder="03/21/2020" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="departure">Departure</label>
                                <input type="date" class="form-control" name="departure" placeholder="03/23/2020" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="breakfast">Breakfast</label>
                                <select class="form-control" name="breakfast_id">
                                    @foreach ($breakfastsInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="extra_service">Any extra service?</label>
                                <select class="form-control" name="extra_service_id">
                                    @foreach ($extra_serviceInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->name }} -
                                            ${{ $option->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Book it</button>
                </form>
            </div>
        </div>
    </div>
@endsection
