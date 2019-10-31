<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="navbar-nav w-100">
        <a class="navbar-brand text-color" href="/">CremHotel</a>
        <a class="nav-item nav-link" href="{{ route('rooms') }}">Посмотреть комнаты</a>

    @if (Route::has('login'))
            <div class="ml-auto">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        @endif
    </div>
</nav>
