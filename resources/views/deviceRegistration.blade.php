@extends('layouts.app')

@section('content')
<div class="setup-instructions u-flex space-between">
    <div class="card u-good-measure two-column">
        <div class="header red">
            <h2>Let's setup a device!</h2>
        </div>
        <div class="body">
            <p>
                In order to test your internet speed, we'll need to
                communicate with some computer on your local network.
                We'd reccomend something like a Raspberry Pi, but as long as you can
                meet the minimum requirements, you should be good!
            </p>
        </div>

    </div>
    <div class="card u-margin three-column">
        <div class="header">
            <h2>Instructions</h2>
        </div>
        <div class="body">
            <p>
                In order to test your internet speed, we'll need to
                communicate with some computer on your local network.
                We'd reccomend something like a Raspberry Pi, but as long as you can
                meet the minimum requirements, you should be good!
            </p>
            <p>
                <code>  {{$user->token}} </code>
            </p>
        </div>

    </div>
</div>
@endsection
