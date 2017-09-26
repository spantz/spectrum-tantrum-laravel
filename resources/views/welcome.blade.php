@extends('layouts.app')

@section('banner')
  <div class="banner banner--main">
    <div class="head slide-up delay-500">ISPs are watching your traffic.</div>
    <div class="subhead slide-up delay-1500">Now you can watch theirs.</div>
  </div>
  <div class="cards u-flex space-between">
    @component('partials/card')
      @slot('title')
        <h3>Accountability</h3>
      @endslot
      @slot('body')
        <p>Accountability</p>
      @endslot
      @slot('footer', 'Accountability')

    @endcomponent
    @component('partials/card')
       @slot('title')
        <p>Power</p>
      @endslot
      @slot('body', 'Power')
      @slot('footer', 'Power')
    @endcomponent
      @component('partials/card')
       @slot('title')
        <p>Methanphetamines</p>
      @endslot
      @slot('body', 'Methanphetamines')
      @slot('footer', 'Methanphetamines')
    @endcomponent
  </div>

@endsection
