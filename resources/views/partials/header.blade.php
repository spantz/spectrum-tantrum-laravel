<div class="header">
    <h2 class="title"><a href="{{ url('/') }}">ISPing</a></h2>
    @if (Route::has('login'))
        @if (Auth::check())
        <div class="u-flex">
            <a class="button" href="{{ url('/settings') }}">Settings</a>
            {{--  <form action="{{ url('/logout') }}" method="post">  --}}
                {{--  {{ csrf_field() }}  --}}

                <a href="{{ url('/logout') }}" class="button">Logout</a>
            {{--  </form>  --}}
        </div>
        @else
        <div class="u-flex flex-end">

          @if(Request::route()->getName() != 'login')
              <a href="{{ url('/login') }}" class="button">Login</a>
              <a href="{{ url('/register') }}" class="button">Register</a>
          @endif
        </div>
        @endif
    @endif
</div>
