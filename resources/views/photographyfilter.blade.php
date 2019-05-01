@extends('layouts.app')

@section('content')

<div id="index" class="container">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="h-100">
					<div class="card">
						<div class="card-body">
							<h2>Filters</h2>
							<hr class="style10">
							<label for='price'>Price:</label>
							<input type="text" id="price" name="price_range" value="" />
							<hr class="style10">

							<hr class="style10">
							<h6><strong>Colors:</strong></h6>
								@forelse($colors as $color)
								<div class="form-check" onClick="window.location = '{{ url('photography/colors/'.$color->name.'/1')}}';">
								  <label class="form-check-label">
								    <input type="radio" class="form-check-input" name="optradio">{{$color->name}}
								  </label>
								</div>
								@empty
								<p> no posts found </p>
								@endforelse


						</div>
					</div>
				</div>
			</div>

			<div class="col-md-9">
				<div class="row">
					@forelse($productsview as $product)
					<div class="col-md-4 card-margin d-flex align-items-stretch">
						<div class="card">
							<a href="/description/{{$product->id}}"><img class="card-img-top" src="{{asset($product->file)}}" alt="Card image cap"></a>
							<div class="card-body">
								<h5 class="card-title">{{$product->product_name}}</h5>
            					<p class="card-text">{{ str_limit($product->product_description, 80) }}</p>
							</div>
							<div class="card-footer">
								<a href="{{ url('/addToCart', $product->id) }}" class="btn btn-lg btn-light"><i class="fas fa-shopping-cart top" id="carticon"></i></a>
								<p style="float: right; font-size: 18px; padding-top: 10px; color: grey;">€ {{ number_format($product->price, 2,'.',',')}}</p>
								<a href="{{ Route('wishlist.add', $product->id) }}" class="btn btn-lg btn-light"><i class="far fa-heart top" id="wishlisticon"></i></a>
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
</div>
<script>
$("#price").ionRangeSlider({
	hide_min_max: true,
	keyboard: true,
	min: 0,
	max: {{ App\Product::max('price')}},
	from: @if(!empty(session()->get('min-price'))){{ session()->get('min-price')}} @else 0 @endif,
	to: @if(empty(session()->get('max-price'))){{ App\Product::max('price')}}@else{{session()->get('max-price')}}@endif,
	type: 'double',
	step: 1,
	prefix: "€",
	grid: true,
	onChange: function (data) {
		from = data.from;
		to = data.to;
	},
	onFinish: function(data) {
		$.ajax({
			url: "{{ route('ajax.update.priceslider') }}",
			type: 'post',
			data: {
				'_token': '{{ csrf_token() }}',
				'from': data.from,
				'to': data.to
			},
			success: function() {
				location.reload();
			}
		});
	}
});
</script>
<div class="text-center" id="pagination">
	{!!$productsview->render();!!}
</div>

@endsection
