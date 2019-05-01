@extends('layouts.app')

@section('content')
	<div class="container main">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:10%">Product</th>
							<th style="width:40%"></th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						@forelse($cartlines as $cartline)
							<tr>
								<td data-th="Product">
									<div class="row">

										{{-- <div class="col-sm-3 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div> --}}
										<div class="col-sm-3 hidden-xs"><img src="{{asset($cartline->product->ProductImages['file'])}}" width="100px" height="100px" alt="Card image cap"></div>

									</div>
								</td>
								<td data-th="Product">
									<h4 class="nomargin">{{ $cartline->product->product_name}}</h4>
								</td>
								<td data-th="Price">€{{ number_format($cartline->product->price,2,",",".")}}</td>
								<td data-th="Quantity">
									<input type="number" class="form-control text-center" value="{{ $cartline->amount }}" id="amount{{$cartline->product_id}}">
								</td>
								<td data-th="Subtotal" class="text-center subttl" value="{{ ($cartline->product->price * $cartline->amount) }}">€{{ number_format($cartline->product->price * $cartline->amount,2,".",",") }}</td>
								<td class="actions" data-th="">
									<button class="btn btn-info btn-sm updateCart" value="{{$cartline->product->id}}"><i class="fas fa-sync-alt"></i></button>
									<a href="{{ url('/cart/remove', $cartline->id) }}" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
								</td>
							</tr>
						@empty
							<tr><td>You have no products in your cart.</td></td>
						@endforelse
					</tbody>
					<tfoot>
						<tr>

							<td colspan="4" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong id="totalPrice"></strong></td>
						</tr>
						<tr>
							<td><a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="3" class="hidden-xs"></td>
							<td colspan="2">@if($cartlines->count() > 0)<a href="{{ url('/address') }}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>@endif</td>
					</tfoot>
				</table>

			</div>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		$('.updateCart').click(function() {
			var productid = $(this).attr('value');
			var amount = $('#amount' + productid).val();

			$.ajax({
				url: "{{ url('/cart/edit')}}",
				type: 'post',
				dataType: "application/json",
				data: {
					'_token': '{{ csrf_token() }}',
					'productid': productid,
					'amount': amount,
				},
			})
			$(document).ajaxStop(function(){
			    window.location.reload();
			});

		});
		var totalPrice = 0;
		$('.subttl').each(function(index) {
			// alert($('#subttl').attr('value'));
			// totalPrice = totalPrice + $('#subttl').val();
			totalPrice += Number($(this).attr('value'));
		});
		$('#totalPrice').text("Total € " + totalPrice.toFixed(2));
	});
	</script>
@endsection
