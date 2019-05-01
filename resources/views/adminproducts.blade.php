@extends('voyager::master')

@section('content')
<div class="container">


<!-- charts -->
<div class="row">
  <div class="col-md-6">
<a href="{{ url('/adminproducts')}}" class="btn btn-primary btn-lg">General Overview</a>
<a href="{{ url('/admin2/products/2018')}}" class="btn btn-primary btn-lg">Last Year</a>
<a href="{{ url('/admin2/products/2019')}}" class="btn btn-primary btn-lg">Current Year</a>
<a href="{{ url('/admin2/products/LastMonth')}}" class="btn btn-primary btn-lg">Last Month</a>
<a href="{{ url('/admin2/products/CurrentMonth')}}" class="btn btn-primary btn-lg">Current month</a>
  </div>
<div class="col-md-12">
   {!! $chart->html() !!}
</div>
<div class="col-md-6 offset-md-2 mt-5">
   {!! $pie_chart->html() !!}
</div>
<div class="col-md-6 offset-md-2 mt-5">
   {!! $line_chart->html() !!}
</div>
<div class="col-md-12 offset-md-2 mt-5">
   {!! $chart_subs->html() !!}
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $pie_chart->script() !!}
{!! $line_chart->script() !!}
{!! $chart_subs->script() !!}


@endsection
