<div class="header">
    <h2 class="title"><a href="{{ url('/') }}">ISPing</a></h2>
    @if (Route::has('login'))
        @if (Auth::check())
        <div class="u-flex">
            <a class="button" href="{{ url('/settings') }}">Settings</a>
            <form action="{{ url('/logout') }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="button">Logout</button>
            </form>
        </div>
        @else
            @if(Request::route()->getName() != 'login')
                <a href="{{ url('/login') }}" class="button">Login</a>
            @endif
        @endif
    @endif
</div>