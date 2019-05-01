@extends('layouts.app')

@section('content')
<div class="container main">
	<div class="row">
		<div class="col-md-12">
			<table width="100%">
				<tr>
					<th>Ordernummer</th>
					<th>Datum</th>
					<th>Prijs</th>
					<th>Status</th>
				</tr>
				<tr>
					<td>{{$order->ordernumber}}</td>
					<td>{{$order->created_at}}</td>
					<td></td>
					<td>{{$order->status}}</td>
				</tr>
			</table>
			<br /><br />
			<table width="100%">
				<tr>
					<th>&nbsp;</th>
					<th>Product</th>
				</tr>

				@foreach($orderDetails as $details)
				<tr>
					<td><img style="max-width: 100px; max-height: 100px;" src="{{asset($details->product->ProductImages->file)}}"></td>
					<td>{{$details->product->product_name}}</td>
				</tr>
				@endforeach

			</table>
		</div>
	</div>
</div>
@endsection
