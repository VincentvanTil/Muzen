<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function ProductCategries()
  {

    return $this->belongsToMany('App\Product', 'product_categories')
    ->using('App\Pivots\product_categories');
  }

  public function GetRouteKeyName()
  {
    return 'name';
  }
  
}
