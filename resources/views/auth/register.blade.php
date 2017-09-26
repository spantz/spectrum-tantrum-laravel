@extends('layouts.app')

@section('content')
<div class="u-flex center">

<div class="card">
  <div class="header tabs">
     <a href="{{ url('login') }}" class="title tab ">Login</a>
     <a href="{{ url('register') }}" class="title tab active">Register</a>
  </div>
  <div class="body">
     <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <label>
                     <div class="label">Name</div>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                     @if ($errors->has('name'))
                        <div class="error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </label>
                <label>
                     <div class="label">Email Address</div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                     @if ($errors->has('name'))
                        <div class="error">
                            <strong>{{ $errors->first('name') }}</strong>
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
                <label>
                     <div class="label">Confirm Password</div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </label>
                <label>
                     <div class="label">Expected Speed (Mb)</div>
                    <input id="expected-speed" type="number" class="form-control" name="expected_speed" required>
                    @if ($errors->has('expected_speed'))
                        <div class="error">
                            <strong>{{ $errors->first('expected_speed') }}</strong>
                        </div>
                    @endif
                </label>

            <button type="submit" href="{{ url('register') }}" class="button primary">Register</button>
        </form>
  </div>
</div>

@endsection
