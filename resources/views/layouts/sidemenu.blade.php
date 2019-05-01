<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>MUZEN</title>

  <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" />
  <script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
  <script src="{{ asset('js/webshop.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<!-- Navbar -->

</head>
<body>
  <div class='wrapper' id="app">
    @include('flash-message')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ url('/')}}">MUZEN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/photography')}}">Photography<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/illustrations')}}">Illustrations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('3DArt')}}">3DArt</a>
					</li>
				</ul>
				<div class="right-menu">
				<li class="fancy nav-item">
					<p class="fancy" id="upload">Upload</p><a href="{{ url('/upload')}}"><i class="fas fa-plus-circle top" id="uploadicon"></i></a>
				</li>
			</div>
				{{-- <form class="form-inline" action="{{route('search')}}" method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form> --}}
				@guest
				<li class="nav-item dropdown-expand-sm">
					<a class="nav-link dropdown-toggle top" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user-circle"></i>
					</a>
					<div class="dropdown-menu">
						<form method="POST" action="{{ route('login') }}" class="px-4 py-3">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="exampleDropdownFormEmail1">Email address</label>
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
								<!-- <input type="email" class="form-control" id="exampleDropdownFormEmail1" > -->
							</div>
							<div class="form-group">
								<label for="exampleDropdownFormPassword1">Password</label>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
								<!-- <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password"> -->
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
								</label>
							</div>
							<button type="submit" class="btn btn-primary">Sign in</button>
						</form>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ url('/register') }}">New around here? Sign up</a>
						<a class="dropdown-item" href="#">Forgot password?</a>
					</div>
				</li>
				@else
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle top" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="far fa-user-circle"></i> {{ Auth::user()->name }} <span class="caret"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{url('/account')}}"><i class="fas fa-user"></i> Account</a>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
				<li class="nav-item dropdown-expand-md">
					<a class="nav-link dropdown-toggle top" href="#" id="navbarDropdownLeft" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-search top"></i>
					</a>
					<div class="dropdown-menu" style="padding: 10px;width:300px;">
						<form action="{{route('search')}}" method="get" >
							<input type="text" placeholder="Search..." name="search" class="form-control" required>
							<br />
							<input type="submit" value="Search" class="btn btn-primary" style="width: 100%;">
						</form>
					</div>
				</li>
				<div class="right-menu">
					{{-- <li class="fancy nav-item"><p class="fancy" id="cart">Cart</p><a href="{{ url('/cart')}}"><i class="fas fa-shopping-cart top" id="carticon"></i></a></li> --}}
					<?php $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']; ?>
					<a href="{{ url('/wishlist')}}">
						<div id="ex4" style="display: inline; font-size: 8px;color: rgba(0, 0, 0, 0.5);">
							<span class="p1 fa-stack fa-2x has-badge" data-count="@if(Auth::guest()) {{ App\Wishlist::where('ip', $ip)->count() }} @else {{ App\Wishlist::where('user_id', Auth::user()->id)->count() }} @endif">
								<!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
								<i class="far fa-heart top" id="wishlisticon"></i>
							</span>
						</div>
					</a>
					<a href="{{ url('/cart')}}">
						<div id="ex4" style="display: inline; font-size: 8px;color: rgba(0, 0, 0, 0.5);">
							<span class="p1 fa-stack fa-2x has-badge" data-count="@if(Auth::guest()) {{ App\Cart::where('ip', $ip)->count() }} @else {{ App\Cart::where('user_id', Auth::user()->id)->count() }} @endif">
								<!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->
								<i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
							</span>
						</div>
					</a>
				</div>
			</div>
		</nav>
  @yield('sidecontent')
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card bg-white border mt-5" style="height: 46rem;">
          <div class="card-body">
              <ul class="list-group">
                <li class="pb-2 border-0 list-group-item"><a href="{{url('/account')}}">Account Settings</a></li>
                <li class="pb-2 border-0 list-group-item"><a href="{{url('/gallery')}}">Gallery</a></li>
                <li class="pb-2 border-0 list-group-item"><a href="{{ route('orders.show')}}">Orders</a></li>
                <li class="pb-2 border-0 list-group-item"><a href="{{url('/subscription')}}">Subscription</a></li>
              </ul>
            </div>
        </div>
      </div>
      <div class="col-md-9">
        @yield('content')
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="fixed-bottom footer mt-5" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
          <h3> Quick Links </h3>
          <ul>
            <li> <a href="{{ route('faq.footer')}}"> F.A.Q </a> </li>
            <li> <a href="{{ route('contact.form')}}"> Contact </a> </li>
            <li> <a href="{{ route('privacypolicy.footer')}}"> Privacy Policy </a> </li>
            <li> <a href="{{ route('payments.footer')}}"> Payments </a> </li>
            <li> <a href="{{ url('/admin2')}}"> Admin </a> </li>
          </ul>
        </div>
      </div>
      <!--/.row-->
    </div>
    <!--/.container-->
  </div>
  <!--/.footer-->

  <!--/.footer-bottom-->
</footer>
</div>
</body>
</html>
