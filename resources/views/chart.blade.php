@extends('layouts.app')

@section('content')

<div class="container">

  <div class="panel panel-primary">

    <div class="panel-heading"> Charts </div>

    <div class="panel-body">

      {!! $chart->render() !!}

    </div>

  </div>

</div>

  {!! Charts::scripts() !!}
  {!! $chart->script() !!}

@endsection
