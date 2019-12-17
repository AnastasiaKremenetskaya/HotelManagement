@extends('layouts.admin_app')

@section('content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">
                @if($update ?? false)
                    Изменить бронь
                @else
                    Добавить бронь
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

                    <form action="{{ $route }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user">Бронь зарегистрирована администратором:</label>
                                    <select class="form-control" name="administrator_id">
                                        @foreach ($administrators as $administrator)
                                            <option value="{{$administrator->id}}">{{ $administrator->staff->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user">Выберите пользователя</label>
                                    <select class="form-control" name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="room">Тип комнаты</label>
                                    <select class="form-control" name="room_id">
                                        @foreach ($rooms as $option)
                                            <option value="{{$option->id}}">{{ $option->classification }} -
                                                ${{ $option->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="guests">Число гостей</label>
                                    <input class="form-control" name="num_of_guests" placeholder="1" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="arrival">Прибытие</label>
                                    <input type="date" class="form-control" name="arrival" placeholder="03/21/2020" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="departure">Выезд</label>
                                    <input type="date" class="form-control" name="departure" placeholder="03/23/2020" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="breakfast">Завтрак</label>
                                    <select class="form-control" name="breakfast_id">
                                        @foreach ($breakfastsInfo as $option)
                                            <option value="{{$option->id}}">{{ $option->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="extra_service">Доп услуги?</label>
                                    <select class="form-control" name="extra_service_id">
                                        @foreach ($extra_serviceInfo as $option)
                                            <option value="{{$option->id}}">{{ $option->name }} -
                                                ${{ $option->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">Забронировать</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
