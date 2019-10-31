@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите свой емэйл адрес') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Свежая ссылка для подтверждения была отправлена вам на почту.') }}
                        </div>
                    @endif

                    {{ __('Проверьте свой почтовый адрес еще раз, пожалуйста.') }}
                    {{ __('Если вы не получили письмо') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите, чтобы мы повторно его отправили') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
