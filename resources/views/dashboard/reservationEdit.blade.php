@extends('index')
@section('title', 'Edit Reservation')

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">Зарезервируйте свое пребывание в лучшем отеле мира!</p>
                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="room">Тип комнаты</label>
                                <select class="form-control" name="room_id"
                                        value="{{ old('room_id', $reservation->room_id) }}">
                                    @foreach ($roomInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->classification }} -
                                            ${{ $option->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="guests">Число гостей</label>
                                <input class="form-control" name="num_of_guests"
                                       value="{{ old('num_of_guests', $reservation->num_of_guests) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="arrival">Прибытие</label>
                                <input type="date" class="form-control" name="arrival" placeholder="03/21/2020"
                                       value="{{ old('arrival', $reservation->arrival) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="departure">Выезд</label>
                                <input type="date" class="form-control" name="departure" placeholder="03/23/2020"
                                       value="{{ old('departure', $reservation->departure) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="breakfast">Завтрак</label>
                                <select class="form-control" name="breakfast_id"
                                        value="{{ old('breakfast_id', $reservation->breakfast_id) }}">
                                    @foreach ($breakfastsInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="extra_service">Хотите доп услуги?</label>
                                <select class="form-control" name="extra_service_id"
                                        value="{{ old('extra_service_id', $reservation->extra_service_id) }}">
                                    @foreach ($extra_serviceInfo as $option)
                                        <option value="{{$option->id}}">{{ $option->name }} -
                                            ${{ $option->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Подтвердить</button>
                </form>
            </div>
        </div>
        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <p class="text-right">
                <button type="submit" class="btn btn-sm text-danger">Удалить бронь</button>
            </p>
        </form>
    </div>
@endsection
