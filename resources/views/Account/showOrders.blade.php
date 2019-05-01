@extends('layouts.sidemenu')

@section('content')
<div class="container main">
	<div class="row">
		<div class="col-md-12">
			<table width="100%">
				<tr>
					<th>Ordernumber</th>
					<th>Date</th>
					<th>Price</th>
					<th>Status</th>
				</tr>
				@forelse($orders as $order)
				<tr>
					<td>{{$order->ordernumber}}</td>
					<td>{{$order->created_at}}</td>
					<td></td>
					<td>{{$order->status}}</td>
				</tr>
				@empty
				<tr>
					<td colspan=4>No orders have been found</td>
				</tr>
				@endforelse
			</table>
		</div>
	</div>
</div>
@endsection
