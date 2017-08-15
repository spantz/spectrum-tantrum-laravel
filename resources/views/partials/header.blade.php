<div class="header">
    <h1>ISPing</h1>
        @if (Route::has('login'))
        {{--  <div>  --}}
            @if (Auth::check())
            <div class="u-flex">
                <a class="button" href="{{ url('/settings') }}">Settings</a>
                <form action="{{ url('/logout') }}" method="post">
                    {{ csrf_field() }}
                     <button type="submit" class="button">Logout</button>
                </form>
            </div>
            @else
                <a href="{{ url('/login') }}" class="button">
                    Login
                </a>
            @endif
        {{--  </div>  --}}
    @endif
</div>