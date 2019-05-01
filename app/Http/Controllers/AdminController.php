<?php

namespace App\Http\Controllers;

Use Illuminate\Http\Request;

Use App\Product;
Use Charts;
Use DB;
Use App\User;
Use App\Order_Detail;
Use App\Subscription;
Use Auth;

class AdminController extends Controller
{
    public function index() {
      $productsArray = Product::orderBy('product_name')
      ->pluck('product_name')
      ->toArray();


      // $chart = Charts::create('bar', 'highcharts')
      //     ->title("Product Details")
      //     ->elementLabel("Total Products")
      //     ->dimensions(1000, 500)
      //     ->responsive(true);
      //     //->groupByMonth(date('Y'), true);

  $SubSold = DB::table('subscriptions')
    ->select(DB::raw('SUM(amount) as amount'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('amount')
   ->toArray();

  $MonthAndYear = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('monthyear')
   ->toArray();

   $SubMonthYear = DB::table('subscriptions')
     ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('monthyear')
    ->toArray();



    $Soldquantity = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('total_expense')
    ->toArray();



  $Soldquantity1 = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('order_details.created_at', 'asc')
  ->pluck('total')->toArray();

  $Soldproducts = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('total','asc')
  ->take(5)
  ->pluck('total')->toArray();

  $SoldName = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=' , 'products.id')
  ->select('order_details.product_id','products.product_name', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id', 'products.product_name')
  ->orderBy('total', 'asc')
  ->pluck('products.product_name')->toArray();


  $Month = DB::table('order_details')
    ->select('order_details.product_id', 'order_details.created_at', DB::raw('SUM(order_details.amount)as total'))
    ->groupBy('order_details.product_id', 'order_details.created_at')
    ->orderBy('order_details.created_at', 'asc')
    ->pluck('order_details.created_at')->toArray();


    $Price = DB::table('order_details')
    ->select(DB::raw('SUM(amount * product_price) as total'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
  //  ->orderByRaw('')
    ->pluck('total')
   ->toArray();
  // $Price = DB::table('order_details')
  // ->select('order_details.product_id', 'order_details.product_price', 'order_details.amount', DB::raw('(order_details.product_price * order_details.amount)as price'))
  // ->groupBy('order_details.product_id', 'order_details.product_price', 'order_details.amount')
  // ->orderBy('price', 'asc')
  // ->pluck('order_details.product_price')->toArray();

  $PerDay = DB::table('order_details')
      ->select(DB::raw('SUM(order_details.amount) as total'), DB::raw("CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as daymonthyear"))
      ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC, daymonthyear'))
      ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
        'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
      ->pluck('daymonthyear')
      ->toArray();

  $PerDayValue = DB::table('order_details')
     ->select(DB::raw('SUM(amount) as total_expense, MONTH(created_at) as month, YEAR(created_at) as year,DAY(created_at) as day'))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('total_expense', 'day')
     ->toArray();

  $chart_subs = Charts::database(Subscription::all(),'bar', 'highcharts')
    ->title('Subscribers')
    ->elementLabel('Subscriptions bought')
    ->labels($SubMonthYear)
    ->values($SubSold)
    ->dimensions(1500,500)
    ->responsive(true);

// hoeveel opbrengst
  $line_chart = Charts::create('line', 'highcharts')
    ->title('Turnover')
    ->elementLabel('€ Euro')
    ->labels($MonthAndYear)
    ->values($Price)
    ->dimensions(1500,500)
    ->responsive(true);


// chart voor hoeveel producten per maand
  $chart = Charts::database(Order_Detail::all(),'bar', 'highcharts')
    ->title('Products sold')
    ->elementLabel('Product quantity')
    ->labels($MonthAndYear)
    ->values($Soldquantity)
    ->dimensions(1500,500)
    ->responsive(true);

// chart voor welke producten het meest verkocht zijn
  $pie_chart = Charts::create('pie', 'highcharts')
      ->title('Popular product sales')
      ->elementLabel('Products')
      ->labels($SoldName)
      ->values($Soldproducts)
      ->dimensions(1500,500)
      ->responsive(true);

      return view('/adminproducts',compact('chart','chart_subs' , 'pie_chart', 'line_chart', 'areaspline_chart', 'percentage_chart', 'geo_chart', 'area_chart', 'donut_chart'));




    }
    public function adminProducts2018() {
      //$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

      $productsArray = Product::orderBy('product_name')
      ->pluck('product_name')
      ->toArray();


      // $chart = Charts::create('bar', 'highcharts')
      //     ->title("Product Details")
      //     ->elementLabel("Total Products")
      //     ->dimensions(1000, 500)
      //     ->responsive(true);
      //     //->groupByMonth(date('Y'), true);

  $SubSold = DB::table('subscriptions')
    ->select(DB::raw('SUM(amount) as amount'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('amount')
   ->toArray();

  $MonthAndYear = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('monthyear')
   ->toArray();

   $SubMonthYear = DB::table('subscriptions')
     ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('monthyear')
    ->toArray();



    $Soldquantity = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('total_expense')
    ->toArray();



  $Soldquantity1 = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('order_details.created_at', 'asc')
  ->pluck('total')->toArray();

  $Soldproducts = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('total','asc')
  ->take(5)
  ->pluck('total')->toArray();

  $SoldName = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=' , 'products.id')
  ->select('order_details.product_id','products.product_name', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id', 'products.product_name')
  ->orderBy('total', 'asc')
  ->pluck('products.product_name')->toArray();


  $Month = DB::table('order_details')
    ->select('order_details.product_id', 'order_details.created_at', DB::raw('SUM(order_details.amount)as total'))
    ->groupBy('order_details.product_id', 'order_details.created_at')
    ->orderBy('order_details.created_at', 'asc')
    ->pluck('order_details.created_at')->toArray();


    $Price = DB::table('order_details')
    ->select(DB::raw('SUM(amount * product_price) as total'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
  //  ->orderByRaw('')
    ->pluck('total')
   ->toArray();
  // $Price = DB::table('order_details')
  // ->select('order_details.product_id', 'order_details.product_price', 'order_details.amount', DB::raw('(order_details.product_price * order_details.amount)as price'))
  // ->groupBy('order_details.product_id', 'order_details.product_price', 'order_details.amount')
  // ->orderBy('price', 'asc')
  // ->pluck('order_details.product_price')->toArray();

  $PerDay = DB::table('order_details')
      ->select(DB::raw('SUM(order_details.amount) as total'), DB::raw("CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as daymonthyear"))
      ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC, daymonthyear'))
      ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
        'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
      ->pluck('daymonthyear')
      ->toArray();

  $PerDayValue = DB::table('order_details')
     ->select(DB::raw('SUM(amount) as total_expense, MONTH(created_at) as month, YEAR(created_at) as year,DAY(created_at) as day'))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('total_expense', 'day')
     ->toArray();

  $chart_subs = Charts::database(Subscription::all(),'bar', 'highcharts')
    ->title('Subscriptions bought')
    ->elementLabel('Subscriptions')
    ->labels($SubMonthYear)
    ->values($SubSold)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByMonth('2018');

// hoeveel opbrengst
  $line_chart = Charts::create('line', 'highcharts')
    ->title('Turnover')
    ->elementLabel('€ Euro')
    ->labels($MonthAndYear)
    ->values($Price)
    ->dimensions(1500,500)
    ->responsive(true);


// chart voor hoeveel producten per maand
  $chart = Charts::database(Order_Detail::all(),'bar', 'highcharts')
    ->title('Products sold')
    ->elementLabel('Products quantity')
    ->labels($MonthAndYear)
    ->values($Soldquantity)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByMonth('2018');

// chart voor welke producten het meest verkocht zijn
  $pie_chart = Charts::create('pie', 'highcharts')
      ->title('Popular product sales')
      ->elementLabel('Products')
      ->labels($SoldName)
      ->values($Soldproducts)
      ->dimensions(1500,500)
      ->responsive(true);


      return view('/adminproducts',compact('chart','chart_subs' , 'pie_chart', 'line_chart', 'areaspline_chart', 'percentage_chart', 'geo_chart', 'area_chart', 'donut_chart'));
    }


    public function adminProductsThisMonth() {
      //$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

      $productsArray = Product::orderBy('product_name')
      ->pluck('product_name')
      ->toArray();


      // $chart = Charts::create('bar', 'highcharts')
      //     ->title("Product Details")
      //     ->elementLabel("Total Products")
      //     ->dimensions(1000, 500)
      //     ->responsive(true);
      //     //->groupByMonth(date('Y'), true);

  $SubSold = DB::table('subscriptions')
    ->select(DB::raw('SUM(amount) as amount'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('amount')
   ->toArray();

  $MonthAndYear = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('monthyear')
   ->toArray();

   $SubMonthYear = DB::table('subscriptions')
     ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('monthyear')
    ->toArray();



    $Soldquantity = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('total_expense')
    ->toArray();



  $Soldquantity1 = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('order_details.created_at', 'asc')
  ->pluck('total')->toArray();

  $Soldproducts = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('total','asc')
  ->take(5)
  ->pluck('total')->toArray();

  $SoldName = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=' , 'products.id')
  ->select('order_details.product_id','products.product_name', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id', 'products.product_name')
  ->orderBy('total', 'asc')
  ->pluck('products.product_name')->toArray();


  $Month = DB::table('order_details')
    ->select('order_details.product_id', 'order_details.created_at', DB::raw('SUM(order_details.amount)as total'))
    ->groupBy('order_details.product_id', 'order_details.created_at')
    ->orderBy('order_details.created_at', 'asc')
    ->pluck('order_details.created_at')->toArray();


    $Price = DB::table('order_details')
    ->select(DB::raw('SUM(amount * product_price) as total'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
  //  ->orderByRaw('')
    ->pluck('total')
   ->toArray();
  // $Price = DB::table('order_details')
  // ->select('order_details.product_id', 'order_details.product_price', 'order_details.amount', DB::raw('(order_details.product_price * order_details.amount)as price'))
  // ->groupBy('order_details.product_id', 'order_details.product_price', 'order_details.amount')
  // ->orderBy('price', 'asc')
  // ->pluck('order_details.product_price')->toArray();

  $PerDay = DB::table('order_details')
      ->select(DB::raw('SUM(order_details.amount) as total'), DB::raw("CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as daymonthyear"))
      ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC, daymonthyear'))
      ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
        'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
      ->pluck('daymonthyear')
      ->toArray();

  $PerDayValue = DB::table('order_details')
     ->select(DB::raw('SUM(amount) as total_expense, MONTH(created_at) as month, YEAR(created_at) as year,DAY(created_at) as day'))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('total_expense', 'day')
     ->toArray();

  $chart_subs = Charts::database(Subscription::all(),'bar', 'highcharts')
    ->title('Subscriptions bought')
    ->elementLabel('Subscriptions')
    ->labels($SubMonthYear)
    ->values($SubSold)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByDay('01','2019');

// hoeveel opbrengst
  $line_chart = Charts::create('line', 'highcharts')
    ->title('Turnover')
    ->elementLabel('€ Euro')
    ->labels($MonthAndYear)
    ->values($Price)
    ->dimensions(1500,500)
    ->responsive(true);


// chart voor hoeveel producten per maand
  $chart = Charts::database(Order_Detail::all(),'bar', 'highcharts')
    ->title('Products sold')
    ->elementLabel('Products quantity')
    ->labels($MonthAndYear)
    ->values($Soldquantity)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByDay('01','2019');

// chart voor welke producten het meest verkocht zijn
  $pie_chart = Charts::create('pie', 'highcharts')
      ->title('Popular product sales')
      ->elementLabel('Products')
      ->labels($SoldName)
      ->values($Soldproducts)
      ->dimensions(1500,500)
      ->responsive(true);


      return view('/adminproducts',compact('chart','chart_subs' , 'pie_chart', 'line_chart', 'areaspline_chart', 'percentage_chart', 'geo_chart', 'area_chart', 'donut_chart'));
    }

    public function adminProducts2019() {
      //$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

      $productsArray = Product::orderBy('product_name')
      ->pluck('product_name')
      ->toArray();


      // $chart = Charts::create('bar', 'highcharts')
      //     ->title("Product Details")
      //     ->elementLabel("Total Products")
      //     ->dimensions(1000, 500)
      //     ->responsive(true);
      //     //->groupByMonth(date('Y'), true);

  $SubSold = DB::table('subscriptions')
    ->select(DB::raw('SUM(amount) as amount'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('amount')
   ->toArray();

  $MonthAndYear = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('monthyear')
   ->toArray();

   $SubMonthYear = DB::table('subscriptions')
     ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('monthyear')
    ->toArray();



    $Soldquantity = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('total_expense')
    ->toArray();



  $Soldquantity1 = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('order_details.created_at', 'asc')
  ->pluck('total')->toArray();

  $Soldproducts = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('total','asc')
  ->take(5)
  ->pluck('total')->toArray();

  $SoldName = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=' , 'products.id')
  ->select('order_details.product_id','products.product_name', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id', 'products.product_name')
  ->orderBy('total', 'asc')
  ->pluck('products.product_name')->toArray();


  $Month = DB::table('order_details')
    ->select('order_details.product_id', 'order_details.created_at', DB::raw('SUM(order_details.amount)as total'))
    ->groupBy('order_details.product_id', 'order_details.created_at')
    ->orderBy('order_details.created_at', 'asc')
    ->pluck('order_details.created_at')->toArray();


    $Price = DB::table('order_details')
    ->select(DB::raw('SUM(amount * product_price) as total'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
  //  ->orderByRaw('')
    ->pluck('total')
   ->toArray();
  // $Price = DB::table('order_details')
  // ->select('order_details.product_id', 'order_details.product_price', 'order_details.amount', DB::raw('(order_details.product_price * order_details.amount)as price'))
  // ->groupBy('order_details.product_id', 'order_details.product_price', 'order_details.amount')
  // ->orderBy('price', 'asc')
  // ->pluck('order_details.product_price')->toArray();

  $PerDay = DB::table('order_details')
      ->select(DB::raw('SUM(order_details.amount) as total'), DB::raw("CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as daymonthyear"))
      ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC, daymonthyear'))
      ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
        'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
      ->pluck('daymonthyear')
      ->toArray();

  $PerDayValue = DB::table('order_details')
     ->select(DB::raw('SUM(amount) as total_expense, MONTH(created_at) as month, YEAR(created_at) as year,DAY(created_at) as day'))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('total_expense', 'day')
     ->toArray();

  $chart_subs = Charts::database(Subscription::all(),'bar', 'highcharts')
    ->title('Subscriptions bought')
    ->elementLabel('Subscriptions')
    ->labels($SubMonthYear)
    ->values($SubSold)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByMonth('2019');

// hoeveel opbrengst
  $line_chart = Charts::create('line', 'highcharts')
    ->title('Turnover')
    ->elementLabel('€ Euro')
    ->labels($MonthAndYear)
    ->values($Price)
    ->dimensions(1500,500)
    ->responsive(true);


// chart voor hoeveel producten per maand
  $chart = Charts::database(Order_Detail::all(),'bar', 'highcharts')
    ->title('Products sold')
    ->elementLabel('Products quantity')
    ->labels($MonthAndYear)
    ->values($Soldquantity)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByMonth('2019');

// chart voor welke producten het meest verkocht zijn
  $pie_chart = Charts::create('pie', 'highcharts')
      ->title('Popular product sales')
      ->elementLabel('Products')
      ->labels($SoldName)
      ->values($Soldproducts)
      ->dimensions(1500,500)
      ->responsive(true);


      return view('/adminproducts',compact('chart','chart_subs' , 'pie_chart', 'line_chart', 'areaspline_chart', 'percentage_chart', 'geo_chart', 'area_chart', 'donut_chart'));
    }


    public function adminProductsLastMonth() {
      //$products = Product::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

      $productsArray = Product::orderBy('product_name')
      ->pluck('product_name')
      ->toArray();


      // $chart = Charts::create('bar', 'highcharts')
      //     ->title("Product Details")
      //     ->elementLabel("Total Products")
      //     ->dimensions(1000, 500)
      //     ->responsive(true);
      //     //->groupByMonth(date('Y'), true);

  $SubSold = DB::table('subscriptions')
    ->select(DB::raw('SUM(amount) as amount'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('amount')
   ->toArray();

  $MonthAndYear = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('monthyear')
   ->toArray();

   $SubMonthYear = DB::table('subscriptions')
     ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('monthyear')
    ->toArray();



    $Soldquantity = DB::table('order_details')
    ->select(DB::raw('SUM(amount) as total_expense'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
    ->pluck('total_expense')
    ->toArray();



  $Soldquantity1 = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('order_details.created_at', 'asc')
  ->pluck('total')->toArray();

  $Soldproducts = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=', 'products.id')
  ->select('order_details.product_id', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id')
  ->orderBy('total','asc')
  ->take(5)
  ->pluck('total')->toArray();

  $SoldName = DB::table('order_details')
  ->join('products', 'order_details.product_id', '=' , 'products.id')
  ->select('order_details.product_id','products.product_name', DB::raw('SUM(order_details.amount)as total'))
  ->groupBy('order_details.product_id', 'products.product_name')
  ->orderBy('total', 'asc')
  ->pluck('products.product_name')->toArray();


  $Month = DB::table('order_details')
    ->select('order_details.product_id', 'order_details.created_at', DB::raw('SUM(order_details.amount)as total'))
    ->groupBy('order_details.product_id', 'order_details.created_at')
    ->orderBy('order_details.created_at', 'asc')
    ->pluck('order_details.created_at')->toArray();


    $Price = DB::table('order_details')
    ->select(DB::raw('SUM(amount * product_price) as total'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC, monthyear'))
    ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 YEAR',
      'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
  //  ->orderByRaw('')
    ->pluck('total')
   ->toArray();
  // $Price = DB::table('order_details')
  // ->select('order_details.product_id', 'order_details.product_price', 'order_details.amount', DB::raw('(order_details.product_price * order_details.amount)as price'))
  // ->groupBy('order_details.product_id', 'order_details.product_price', 'order_details.amount')
  // ->orderBy('price', 'asc')
  // ->pluck('order_details.product_price')->toArray();

  $PerDay = DB::table('order_details')
      ->select(DB::raw('SUM(order_details.amount) as total'), DB::raw("CONCAT_WS('-',DAY(created_at),MONTH(created_at),YEAR(created_at)) as daymonthyear"))
      ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC, daymonthyear'))
      ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
        'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
      ->pluck('daymonthyear')
      ->toArray();

  $PerDayValue = DB::table('order_details')
     ->select(DB::raw('SUM(amount) as total_expense, MONTH(created_at) as month, YEAR(created_at) as year,DAY(created_at) as day'))
     ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC,DAY(created_at) ASC'))
     ->where( 'created_at', '>=', DB::raw( 'LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH',
       'AND', 'created_at',  '<', ' LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY'))
     ->pluck('total_expense', 'day')
     ->toArray();

  $chart_subs = Charts::database(Subscription::all(),'bar', 'highcharts')
    ->title('Subscriptions bought')
    ->elementLabel('Subscriptions')
    ->labels($SubMonthYear)
    ->values($SubSold)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByDay('12','2018');

// hoeveel opbrengst
  $line_chart = Charts::create('line', 'highcharts')
    ->title('Turnover')
    ->elementLabel('€ Euro')
    ->labels($MonthAndYear)
    ->values($Price)
    ->dimensions(1500,500)
    ->responsive(true);


// chart voor hoeveel producten per maand
  $chart = Charts::database(Order_Detail::all(),'bar', 'highcharts')
    ->title('Products sold')
    ->elementLabel('Products quantity')
    ->labels($MonthAndYear)
    ->values($Soldquantity)
    ->dimensions(1500,500)
    ->responsive(true)
    ->groupByDay('12','2018');

// chart voor welke producten het meest verkocht zijn
  $pie_chart = Charts::create('pie', 'highcharts')
      ->title('Popular product sales')
      ->elementLabel('Products')
      ->labels($SoldName)
      ->values($Soldproducts)
      ->dimensions(1500,500)
      ->responsive(true);


      return view('/adminproducts',compact('chart','chart_subs' , 'pie_chart', 'line_chart', 'areaspline_chart', 'percentage_chart', 'geo_chart', 'area_chart', 'donut_chart'));
    }

}
