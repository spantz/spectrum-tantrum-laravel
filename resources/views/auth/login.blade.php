@extends('layouts.app')

@section('content')
<div class="u-flex center">
@component('partials/card')
      @slot('title')
        Login
      @endslot
      @slot('body')
        <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <label>
                    <div class="label">E-mail Address</div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <div class="error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </label>
                <label>
                    <div class="label">Password</div>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <div class="error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </label>
                <div class="u-flex">
                <label class="checkbox">
                    <div class="label">Remember Me</div>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                </label>
                </div>
            </div>
            <div class="footer">
                <a href="{{ url('register') }}" class="button">Register</a>
                <button type="submit" class="button primary">Login</button>
            </div>
        </form>
      @endslot
      @slot('footer', '')

    @endcomponent
    {{--  <div class="card slide-up">
        <div class="header">
            <h1 class="title"></h1>
        </div>

    </div>  --}}
</div>

@endsection
