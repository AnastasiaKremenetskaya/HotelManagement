@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Панель</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Вы вошли в аккаунт!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
</div> <br><br>
<div class="row justify-content-center">
    <a href="{{ route('index') }}" class="btn btn-primary">Бронируй сейчас</a>
</div>

@endsection
