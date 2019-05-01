<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use App\Product;
use App\Product_Images;
use App\Products;
use Auth;


class WishlistController extends Controller
{
    public function index()
  {if(Auth::guest()) {
    $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
    $wished = Wishlist::with('Product', 'User')->where('ip', $ip)->get();
  } else {
    $wished = Wishlist::with('Product', 'User')->where('user_id', Auth::user()->id)->get();
  }
		return view('wishlist', compact('wished'));
	}


  public function store(Request $request)
  {
    $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];

    $user = Auth::user();
    $duplicate = Wishlist::where('user_id', $user->id)
                          ->where('product_id',$request->id)
                          ->first();

    if($duplicate){
      return redirect()->back()->with('success', 'You have already wished for this item!');

    }

    if(Auth::guest()){
    $wishlistitem = new Wishlist();
    $wishlistitem->ip = $ip;
    $wishlistitem->user_id = 1;
    $wishlistitem->product_id = $request->id;
    $wishlistitem->save();
    return redirect()->back()->with('success', 'Product added to wishlist successfully!');
  } else {
      $wishlistitem = new Wishlist();
      $wishlistitem->user_id = Auth::user()->id;
      $wishlistitem->ip = $ip;
      $wishlistitem->product_id = $request->id;
      $wishlistitem->save();
      return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }
  }

  public function show($id)
  {
      $product = Product::find($id);
      return view('description', compact('product','id'));
  }

  public function edit($id)
  {
      //
  }

  public function update()
  {
      //
  }

  public function destroy($id) {
		Wishlist::findOrFail($id)->delete();
		return redirect(url('/wishlist'));
	}


}
