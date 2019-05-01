<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Color extends Model
{
  public $table = 'product_colors';
  public $fillable=['product_id', 'color_id'];

  public function ProductColor()
  {
    return $this->belongsToMany('App\Product');
  }

  public function ProductColor2()
  {
    return $this->belongsToMany('App\Color');
  }

  public function GetRouteKeyName()
  {
    return 'name';
  }
}
