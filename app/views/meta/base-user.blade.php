@extends('meta.meta')

@section('body')

{{-- If not on the dashboard set the background --}}
<body class="body-background">

    @section('navbar')
      @include('meta.navbar-general')
    @show

    @section('pageContent')

    @show

    @section('footer')
      @include('meta.footer')
    @show
  </body>

@stop