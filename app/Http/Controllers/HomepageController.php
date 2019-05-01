<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Product_Tag;
use App\Product_Size;
use App\User;
use Auth;
class HomepageController extends Controller
{
  public function index() {

    # Query for getting the popular products on homepage
	$productspopular = Product::with('ProductSizing', 'ProductTag','ProductImages')
  ->join('product_images', 'products.id', '=', 'product_images.product_id')
	->orderBy('product_name', 'desc')
	->take(4)
	->get();

    # Query for getting latest products on homepage
	$productslatest = Product::with('ProductSizing', 'ProductTag','ProductImages')
  ->join('product_images', 'products.id', '=', 'product_images.product_id')
	->orderBy('products.created_at', 'desc')
	->take(4)
	->get();
    return view('homepage', compact('productspopular', 'productslatest'));
  }
  public function show($id)
  {
    $product = Product::find($id);
    $users = User::find($product->user_id);
    return view('description', compact('product', 'id', 'users'));
  }

  public function faq() {
    return view('faq');
  }

  public function payments() {
    return view('payments');
  }

  public function privacypolicy() {
    return view('privacypolicy');
  }

  public function admin2() {
    return view('admin2');
  }
}
