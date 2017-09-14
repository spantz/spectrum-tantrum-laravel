@extends('layouts.app')


@section('scripts')
    <script src="{{ asset('js/pages/DeviceRegistration.js') }}"></script>
@endsection

@section('content')
<div class="setup-instructions u-flex space-between no-stretch">
    <div class="card u-good-measure two-column u-margin-right _5">
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

            <div id="clipboard"></div>
        </div>

    </div>
    <div class="card u-margin three-column">
        <div class="header">
            <h2>Instructions</h2>
        </div>
        <div class="body">
            <h2>Step 1</h2>
            <p>
                <ul>
                    <li> 
                        <p>
                            <code>Node 7.0.0</code>
                        </p>
                    </li>
                    <li> 
                        <p>
                            <code>Yarn v2</code>
                        </p>
                    </li>
                    <li> 
                        <p>
                            <code>Node v7</code>
                        </p>
                    </li>
                    <li> 
                        <p>
                            <code>Node v7</code>
                        </p>
                    </li>
                </ul>
            </p>
            <p>
                In order to test your internet speed, we'll need to
                communicate with some computer on your local network.
                We'd reccomend something like a Raspberry Pi, but as long as you can
                meet the minimum requirements, you should be good!
            </p>
             <p>
                In order to test your internet speed, we'll need to
                communicate with some computer on your local network.
                We'd reccomend something like a Raspberry Pi, but as long as you can
                meet the minimum requirements, you should be good!
            </p>
             <p>
                In order to test your internet speed, we'll need to
                communicate with some computer on your local network.
                We'd reccomend something like a Raspberry Pi, but as long as you can
                meet the minimum requirements, you should be good!
            </p>
            <p>
                <code> npm run register -- --token '{{$user->token}}' </code>
            </p>
        </div>

    </div>
</div>
@endsection
