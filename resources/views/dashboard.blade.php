@extends('layouts.app')

@section('scripts')
    <script id="aggreate-data" type="application/json">
        {!! $overview->toJson() !!}
    </script>
    <script id="user-data" type="application/json">
        {!! $divided->toJson() !!}
    </script>
    <script src="{{ asset('js/pages/Dashboard.js')}}"></script>
@endsection

@section('content')
    <div id="dashboard" ></div>
@endsection