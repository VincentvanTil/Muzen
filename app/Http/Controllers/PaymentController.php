<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Mollie;

class PaymentController extends Controller
{
    public function createPayment(Request $request) {
		$address = new Address();
		if(Auth::guest()) {
			$address->user_id = 0;
		} else {
			$address->user_id = Auth::user()->id;
		}


		$address->streetname=$request->streetname;
		$address->zipcode=$request->zipcode;
		$address->place=$request->place;
		$address->country_id=$request->country;
		$address->save();

		$order = new Order();
		$order->ordernumber = 'MZ-'.time();
		$order->address_id = 1;
		$order->shipping_method = 1;
		$order->save();


		$payment = Mollie::api()->payments()->create([
		'amount' => [
			'currency' => 'EUR',
			'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
		],
		'description' => 'Payment '.$order->ordernumber,
		'webhookUrl' => route('webhooks.mollie'),
		'redirectUrl' => route('home'),
		]);

		$payment = Mollie::api()->payments()->get($payment->id);

		// redirect customer to Mollie checkout page
		return redirect($payment->getCheckoutUrl(), 303);
	}
}
