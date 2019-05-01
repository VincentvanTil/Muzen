<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscription;
use Carbon\Carbon;
use Auth;
use Mollie;
use Log;
class SubscriptionController extends Controller
{
    public function index() {
      return view('subscription');
    }
	public function buySubscription($id) {
        $totalprice = null;
		if($id == 1)
			$totalprice = "4.00";
		if($id == 2)
			$totalprice = "9.00";
		if($id == 3)
			$totalprice = "12.50";
		$payment = Mollie::api()->payments()->create([
		'amount' => [
			'currency' => 'EUR',
			'value' => $totalprice // You must send the correct number of decimals, thus we enforce the use of strings
		],
		'description' => ''.Auth::user()->id,
		'webhookUrl' => route('webhooks.subscription'),
		'redirectUrl' => route('home'),
		]);

		$payment = Mollie::api()->payments()->get($payment->id);
		return redirect($payment->getCheckoutUrl(), 303);
	}
	public function mollieWebhook(Request $request) {
		$payment = Mollie::api()->payments()->get($request->id);
		Log::error(json_encode($payment));
		if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
				$subscription = new Subscription;
				if($payment->amount->value == 4.00) {
					$subscription->amount = 3;
				} else if($payment->amount->value == 10.00) {
					$subscription->amount = 10;
				} else if($payment->amount->value == 12.50) {
					$subscription->amount = 15;
				}
				$subscription->user_id = $payment->description;
				$subscription->save();
	    }
	}
	public function redirect() {

	}
}
