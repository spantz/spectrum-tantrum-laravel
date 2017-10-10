@extends('layouts.app')


@section('scripts')
    <script src="{{ asset('js/pages/DeviceRegistration.js') }}"></script>
@endsection

@section('content')
<div class="setup-instructions u-flex wrap space-between no-stretch">
    <div class="card u-good-measure two-column u-margin-right _5  slide-up delay-500">
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
    <div id="root" class="card u-margin three-column slide-up delay-1100" data-token="{{$user->token}}"></div>
</div>
@endsection