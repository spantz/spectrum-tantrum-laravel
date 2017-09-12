@extends('layouts.app')

@section('content')
<div class="u-flex center">
    <div class="card">
        <div class="header">
            <h1 class="title">Registration</h1>
        </div>
        <form method="POST" action="{{ route('register') }}">
            <div class="body">
                {{ csrf_field() }}
                <label>
                    <h2>Name</h2>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                     @if ($errors->has('name'))
                        <div class="error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </label>
                <label>
                    <h2>Email Address</h2>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                     @if ($errors->has('name'))
                        <div class="error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </label>
                 <label>
                    <h2>Password</h2>
                    <input id="password" type="password" class="form-control" name="password" required>
                     @if ($errors->has('password'))
                        <span class="error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </label>
                <label>
                    <h2>Confirm Password</h2>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </label>
                <label>
                    <h2>Expected Speed (Mb)</h2>
                    <input id="expected-speed" type="number" class="form-control" name="expected_speed" required>
                    @if ($errors->has('expected_speed'))
                        <span class="error">
                            <strong>{{ $errors->first('expected_speed') }}</strong>
                        </span>
                    @endif
                </label>
            </div>
            <div class="footer">
                <button type="submit" href="{{ url('register') }}" class="button primary">Register</button>
            </div>    
        </form>      
    </div>
</div>
@endsection
