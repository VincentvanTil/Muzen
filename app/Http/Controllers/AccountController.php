<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use App\Mail\mijnmail;
use Mail;

class AccountController extends Controller
{
  public function index() {
    return view('account');
  }
  public function showOrders() {
	  $orders = Order::where('user_id', Auth::user()->id)->get();
	  return view('Account.showOrders', compact('orders'));
  }

  public function contact() {
    return view('contact');
  }

  public function sendMail(Request $request)
  {
    // dd($request->all());
      Mail::raw('Naam: '.$request->name.' Email: '.$request->email.' Bericht: '.$request->message, function($message) {
          $message->to('admin@muzen.com')
          ->subject('Contact form');

      });
      return view('contactsuccess');
  }

}
