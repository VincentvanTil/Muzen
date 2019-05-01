<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;
use App\Products;
use App\Color;
use App\Product;
class DescriptionController extends Controller
{
  public function index() {
		return view('description');
	}
    public function searchTag($name) {
        $colors = Color::all();
        $productsview=Product::with('ProductSizing', 'ProductTag','ProductImages')
            ->leftJoin('product_categories', 'products.id', '=' , 'product_categories.product_id')
            ->leftJoin('categories', 'categories.id' , '=' , 'product_categories.category_id')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->join('product_tags', 'products.id', '=', 'product_tags.product_id')
            ->leftJoin('product_colors', 'products.id', '=', 'product_colors.product_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_colors.color_id')
            ->where('product_tags.name', str_replace('%20', ' ', $name))
            ->paginate(15)->onEachSide(3);;
			// dd($productsview);
        return view('photography', compact('productsview', 'colors'));
    }
}
