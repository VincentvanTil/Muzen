@extends ('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 mt-5">

      <span class="align-text-center" style="text-align:center"><h2>{{$userid->name}}</h2>
        <h2>____</h2>
        <br />
        <h4>A little bit about {{$userid->name}}</h4>
        <br />
        <div class="row justify-content-center">
          <div class="col-md-12">
        <b>{{ $userid->description }}</b>
        </div>
        </div>
      </span>
    </div>
  </div>
</div>

<br />

<div id="index" class="container">
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					@forelse($productsgallery as $product)
					<div class="col-lg-3 d-flex align-items-stretch">
						<div class="card">
						<a href="/description/{{$product->id}}"><img class="card-img-top" src="{{asset($product->file)}}" alt="Card image cap"></a>
							<div class="card-body">
								<h5 class="card-title">{{$product->product_name}}</h5>
								<p class="card-text">{{ str_limit($product->product_description, 80) }}</p>
							</div>
              <div class="card-footer">
							  <a href="{{ url('/addToCart', $product->id) }}" class="btn btn-lg btn-light"><i class="fas fa-shopping-cart top" id="carticon"></i></a>
								<p style="float: right">€ {{ number_format($product->price, 2,'.',',')}}</p>
								<a href="{{ Route('wishlist.add', $product->id) }}" class="btn btn-lg btn-light">
									<img src="https://cdn3.iconfinder.com/data/icons/pyconic-icons-1-2/512/heart-outline-512.png" height="25" class="hello" alt=""/></a>
							</div>
						</div>
					</div>
					@empty
					<p> no posts found </p>
					@endforelse
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
