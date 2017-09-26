@extends('layouts.app')

@section('banner')
  <div class="banner banner--main">
    <div class="head slide-up delay-500">ISPs are watching your traffic.</div>
    <div class="subhead slide-up delay-1500">Now you can watch theirs.</div>
  </div>
  <div class="cards u-flex space-between">
    @component('partials/card')
      @slot('title')
        Accountability
      @endslot
      @slot('body')
        <p>Hold your ISP accountable by tracking your speeds and seeing when they lapse.</p>
      @endslot
      @slot('footer', '')
    @endcomponent

    @component('partials/card')
       @slot('title')
        <p>Trends</p>
      @endslot
       @slot('body')
        <p>Easily track your speeds over time to get the bigger picture about your data.</p>
      @endslot
      @slot('footer', '')
    @endcomponent

  </div>

@endsection
