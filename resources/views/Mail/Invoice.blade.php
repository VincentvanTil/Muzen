<h1>Hi,</h1><br/>
<br/>
<p>Thank you for ordering at MUZEN!</p>
The package will be delivered to:<br/>
{{ $order->address->streetname }}<br/>
{{ $order->address->zipcode }}<br/>
{{ $order->address->place }}<br/>
{{ $order->address->country->name}}<br/>

Your order:
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
	@foreach($order->OrderDetail as $details)
	<tr>
		<td><img style="max-width: 100px; max-height: 100px;" src="{{asset($details->product->ProductImages->file)}}"></td>
		<td>{{$details->product->product_name}}</td>
	</tr>
	@endforeach

</table>
Kind regards,

Team MUZEN!
