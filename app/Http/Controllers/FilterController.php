<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_Tag;
use App\Product_Size;
use App\Color;
use App\Category;
use DB;

class FilterController extends Controller
{
    public function index(Color $color, $categoryid)
    {
      $products = $color->product;

      $productsview = Product::join('product_colors', 'products.id', '=', 'product_colors.product_id')
      ->join('colors', 'colors.id', '=', 'product_colors.color_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->where('colors.name', '=', $color->name)->where('category_id', $categoryid);
      $colors = Color::all();
      $categories = Category::all();
      if(!empty(session()->get('min-price'))) {
      $productsview = $productsview->where('price', '>=', session()->get('min-price'));
      }
      if(!empty(session()->get('max-price'))) {
      $productsview  = $productsview->where('price', '<=', session()->get('max-price'));
      }
      $productsview = $productsview->paginate(9);
      return view('photographyfilter', compact('productsview','products','colors'));
    }

    public function illustrations(Color $color, $categoryid)
    {
      $products = $color->product;

      $productsview = Product::join('product_colors', 'products.id', '=', 'product_colors.product_id')
      ->join('colors', 'colors.id', '=', 'product_colors.color_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->where('colors.name', '=', $color->name)->where('category_id', $categoryid);
      $colors = Color::all();
      $categories = Category::all();
      if(!empty(session()->get('min-price'))) {
      $productsview = $productsview->where('price', '>=', session()->get('min-price'));
      }
      if(!empty(session()->get('max-price'))) {
      $productsview  = $productsview->where('price', '<=', session()->get('max-price'));
      }
      $productsview = $productsview->paginate(9);
      return view('illustrationsfilter', compact('productsview','products','colors'));
    }

    public function ThreeDArt(Color $color, $categoryid)
    {
      $products = $color->product;

      $productsview = Product::join('product_colors', 'products.id', '=', 'product_colors.product_id')
      ->join('colors', 'colors.id', '=', 'product_colors.color_id')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
      ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
      ->where('colors.name', '=', $color->name)->where('category_id', $categoryid);
      $colors = Color::all();
      $categories = Category::all();
      if(!empty(session()->get('min-price'))) {
      $productsview = $productsview->where('price', '>=', session()->get('min-price'));
      }
      if(!empty(session()->get('max-price'))) {
      $productsview  = $productsview->where('price', '<=', session()->get('max-price'));
      }
      $productsview = $productsview->paginate(9);
      return view('3DArtfilter', compact('productsview','products','colors'));
    }




    public function show($id)
    {
      $product = Product::find($id);
    }
}
