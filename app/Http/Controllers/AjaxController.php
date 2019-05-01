<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Auth;
use Session;
class AjaxController extends Controller
{
    public function updateCart(Request $request) {
		if(Auth::guest()) {
			$ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
			$cartline = Cart::where('product_id', $request->productid)->where('ip', $ip)->firstOrFail();
		} else {
			$cartline = Cart::where('product_id', $request->productid)->where('user_id', Auth::user()->id)->firstOrFail();
		}
        if($request->amount != 0) {
            $cartline->amount = $request->amount;
            $cartline->save();
        } else {
            $cartline->delete();
        }
	}
	public function updateSlider(Request $request) {
		// dd($request->all());
		$maxprice = Product::max('price');
		// if($request->)
		try {
			if($request->to != $maxprice) {
				Session::put('max-price', $request->to);
			} else {
				Session::forget('max-price');
			}
			if($request->from != 0) {
				Session::put('min-price', $request->from);
			} else {
				Session::forget('min-price');
			}
			return print("Success");
		} catch(Exception $exception) {
			return print("Error: ".$exception);
		}

	}
}
