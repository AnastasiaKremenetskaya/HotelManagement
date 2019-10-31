@extends('index')
@section('title', 'Dashboard')

@section('content')
    <div class="container text-center my-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Управляйте бронями!</h4>
                        <p class="card-text">Измените свои текущие брони.</p>
                        <a href="/dashboard/reservations" class="btn btn-primary">Мои брони</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Найдите комнату</h4>
                        <p class="card-text">Откройте каталог наших высококлассных комнат!</p>
                        <a href="{{ route('rooms') }}" class="btn btn-primary">Наши комнаты</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
