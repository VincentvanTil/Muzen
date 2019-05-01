<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Product_Tag;
use App\Product_Size;
use App\Color;
use App\Product_Colors;

class IllustrationsController extends Controller
{
  public function index(Request $Request)
  {
    $productsview = Product::with('ProductSizing', 'ProductTag','ProductImages')
    ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
    ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
    ->join('product_images', 'products.id', '=', 'product_images.product_id')
    ->where('product_categories.category_id' , '=', 2);
	if(!empty(session()->get('min-price'))) {
		$productsview = $productsview->where('price', '>=', session()->get('min-price'));
	}
	if(!empty(session()->get('max-price'))) {
		$productsview = $productsview->where('price', '<=', session()->get('max-price'));
	}
	$productsview = $productsview->paginate(9);
  $sqlbuilder = Product::query();
  if(isset($Request -> Sort))
  {
    switch($Request -> Sort)
    {
      default:
      case 'PriceLowToHigh':
      $sqlbuilder = $sqlbuilder->orderBy('price', 'asc')
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->where('product_categories.category_id' , '=', 2);
      break;
      case 'PriceHighToLow':
      $sqlbuilder = $sqlbuilder->orderBy('price', 'desc')
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->where('product_categories.category_id' , '=', 2);
      break;
      case 'Latest':
      $sqlbuilder = $sqlbuilder
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->where('product_categories.category_id' , '=', 2)
      ->latest('products.created_at');
      break;
    }
	if(!empty(session()->get('min-price'))) {
	  $sqlbuilder = $sqlbuilder->where('price', '>=', session()->get('min-price'));
	}
	if(!empty(session()->get('max-price'))) {
	  $sqlbuilder = $sqlbuilder->where('price', '<=', session()->get('max-price'));
	}
    $productsview = $sqlbuilder->paginate(9);
  }

    $colors = Color::all();
    return view('illustrations', compact('products','productsview', 'colors'));
  }
  public function show($id)
  {
    $product = Product::find($id);
  }
}
