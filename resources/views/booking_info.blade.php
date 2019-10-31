@extends('index') {{-- Specify that we want to extend the index file --}}
@section('title', 'Home') {{-- Set the title content to "Home" --}}
{{--  Set the "content" section, which will replace "@yield('content')" in the index file we're extending --}}
@section('content')
    <div class="jumbotron text-light" style="background-image: url('https://sun9-7.userapi.com/c855036/v855036141/11776f/uVfdHwMFrAM.jpg')">
        <div class="container">
            @if(Auth::user())
                <h1 class="display-4">Здравствуй, {{ Auth::user()->name}}!</h1>
                <p class="lead">To your one stop shop for reservation management.</p>
                <a href="/dashboard" class="btn btn-success btn-lg my-2">Просмотреть свои брони</a>
            @else
                <h1 class="display-3">Бронируй легко с Crem Hotel!</h1>
                <p class="lead">Вы можете тут забронировать все что вам нужно! И отдохнуть как следует!!</p>
                <a href="/login" class="btn btn-success btn-lg my-2">Зарегистрируйтесь для доступа к нашим великолепным комнатам</a>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Удобно</h5>
                        <p class="card-text">Управляй всеми бронями в одном месте</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Лучшие цены</h5>
                        <p class="card-text">Мы приготовили специальную скидку</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Прост в использовании</h5>
                        <p class="card-text">Бронируй и управляй одним кликом</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
