<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  public function ProductColors()
  {

    return $this->belongsToMany('App\Product', 'product_colors')
    ->using('App\Pivots\Product_colors');
  }


  #Makes sure that instead of ID people can use name of color in URL
  public function GetRouteKeyName()
  {
    return 'name';
  }
}
