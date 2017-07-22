<div class="header">
    <h1>ISPing</h1>
        @if (Route::has('login'))
        <div>
            @if (Auth::check())
                <a class="button" href="{{ url('/settings') }}">Settings</a>
            @else
                <a href="{{ url('/login') }}" class="button">
                    Login
                </a>
            @endif
        </div>
    @endif
</div>