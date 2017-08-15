@extends('layouts.app')

@section('content')
<div class="u-flex center">
    <div class="card">
        <div class="header">
            <h1 class="title">Login</h1>
        </div>
        <form method="POST" action="{{ route('login') }}">
            <div class="body">
                {{ csrf_field() }}
                <label>
                    <h2>E-mail Address</h2>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                       
                    @endif
                </label>
                <label>
                    <h2>Password</h2>
                    <input id="password" type="password" class="form-control" name="password" required>
                    
                    @if ($errors->has('password'))
                        <div class="error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </label>
                <div class="u-flex">
                    <h3>Remember Me</h3> <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
            </div>
            <div class="footer">
                <button href="{{ url('register') }}" class="button">Register</button>
                <button type="submit" class="button primary">Login</button>
            </div>    
        </form>      
    </div>
</div>

@endsection
