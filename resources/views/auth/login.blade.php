@extends('layouts.app')

@section('content')
<div class="u-flex center">

<div class="card">
  <div class="header tabs">
     <a href="{{ url('login') }}" class="title tab active">Login</a>
     <a href="{{ url('register') }}" class="title tab">Register</a>
  </div>
  <div class="body">
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
            <button type="submit" class="button primary">Login</button>
        </div>
    </form>
  </div>
</div>

@endsection
