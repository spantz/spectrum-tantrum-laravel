@extends('layouts.dashboard')

@section('scripts')
    <script id="overview-data" type="application/json">
        {!! $overview->toJson() !!}
    </script>
    <script id="divided-data" type="application/json">
        {!! $divided->toJson() !!}
    </script>
    <script src="{{ asset('js/pages/Dashboard.js')}}"></script>
@endsection

@section('content')
    <div id="dashboard"></div>
@endsection
