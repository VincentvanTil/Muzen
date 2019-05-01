<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Charts;
Use DB;



class ChartController extends Controller
{
    public function index() {
    $products = Product::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y'))->get();
    $chart = Charts::database($products, 'bar', 'highcharts')
      ->title("Product Details")
      ->elementlabel("Total Products")
      ->dimensions(1000,500)
      ->responsive(false)
      ->groupByMonth(date('Y'), true);



    return view('chart',compact('chart'));
  }
}
