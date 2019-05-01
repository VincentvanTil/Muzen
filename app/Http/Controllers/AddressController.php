<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Address;
use App\Cart;
use App\Country;
use App\Order;
use App\OrderDetail;
use Mollie;
use Mail;
use App\Mail\InvoiceEmail;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$cartlines = null;
		if(Auth::guest()) {
			$ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
			$cartlines = Cart::with('Product')->where('ip', $ip)->get();
		} else {
			$cartlines = Cart::with('Product')->where('user_id', Auth::user()->id)->get();
		}
        $countries = Country::all();
		if($cartlines->count() > 0) {
			return view('address', compact('cartlines', 'countries'));
		} else {
			return redirect(url('/'));
		}

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $this->validate($request, [
			'FirstName' => 'required|min:2',
			'LastName' => 'required|min:2',
          	'streetname'=>'required|min:2',
          	'zipcode'=>'required|min:5',
          	'place'=>'required|min:2',
			'email' => 'required|min:2',
          	'country'=>'required'
        ]);

        $address = new Address();
		if(Auth::user()) {
			$address->user_id = Auth::user()->id;
		} else {
			$address->user_id = 1;
		}
		$address->first_name = $validatedData['FirstName'];
		$address->last_name = $validatedData['LastName'];
        $address->streetname=$validatedData['streetname'];
        $address->zipcode=$validatedData['zipcode'];
        $address->place=$validatedData['place'];
        $address->country_id=$validatedData['country'];
		$address->email=$validatedData['email'];

        $address->save();

		if(Auth::guest()) {
			$ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
			$cartlines = Cart::with('Product')->where('ip', $ip)->get();
		} else {
			$cartlines = Cart::with('Product')->where('user_id', Auth::user()->id)->get();
		}
		$totalprice = 0.00;
		foreach($cartlines as $cartline) {
			$totalprice += $cartline->product->price * $cartline->amount;

		}
		$ordernumber = 'MZ-'.time();
		$order = new Order();
		if(!Auth::guest())
			$order->user_id = Auth::user()->id;

		$order->ordernumber = $ordernumber;
		$order->address_id = 1;
		$order->shipping_method = 1;

		$payment = Mollie::api()->payments()->create([
		'amount' => [
			'currency' => 'EUR',
			'value' => number_format($totalprice, 2), // You must send the correct number of decimals, thus we enforce the use of strings
		],
		'description' => 'Payment '.$ordernumber,
		'webhookUrl' => route('webhooks.mollie'),
		'redirectUrl' => route('payments.end', $ordernumber),
		]);

		$payment = Mollie::api()->payments()->get($payment->id);


		$order->payment = $payment->id;
		$order->save();
		foreach($cartlines as $cartline) {
			$oDetail = new OrderDetail;
			$oDetail->order_id = $order->id;
			$oDetail->product_id = $cartline->product_id;
			$oDetail->product_price = $cartline->product->price;
			$oDetail->amount = $cartline->amount;
			$oDetail->save();
			$cartline->delete();
		}


		// redirect customer to Mollie checkout page
		return redirect($payment->getCheckoutUrl(), 303);
        // return redirect('/address')->with('Success', 'You will receive an email regarding your order shortly');
    }
	public function finishPayment($ordernumber) {
		$order = Order::where('ordernumber', $ordernumber)->firstOrFail();
		$orderDetails = OrderDetail::with('Product')->where('order_id', $order->id)->get();
		return view('ThankYou', compact('order', 'payment', 'orderDetails'));
	}
	public function mollieWebhook(Request $request) {
		// $order = Order::with('OrderDetail')->where('ordernumber', $ordernumber)->firstOrFail();
		$payment = Mollie::api()->payments()->get($request->id);
		$order = Order::with('Address')->where('payment', $request->id)->first();

		if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
	        /*
	         * The payment is paid and isn't refunded or charged back.
	         * At this point you'd probably want to start the process of delivering the product to the customer.
	         */
			 $order->status = 'paid';
			 Mail::to($order->address->email)->send(new InvoiceEmail($order->id));
	    } elseif ($payment->isOpen()) {
	        /*
	         * The payment is open.
	         */
			 $order->status = 'unpaid';
	    } elseif ($payment->isPending()) {
	        /*
	         * The payment is pending.
	         */
	    } elseif ($payment->isFailed()) {
	        /*
	         * The payment has failed.
	         */
			 $order->status = 'failed';
	    } elseif ($payment->isExpired()) {
	        /*
	         * The payment is expired.
	         */
			 $order->status = 'failed';
	    } elseif ($payment->isCanceled()) {
	        /*
	         * The payment has been canceled.
	         */
			 $order->status = 'failed';
	    }
		$order->save();
	}
}
