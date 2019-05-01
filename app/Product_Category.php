<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    public $table = 'product_categories';
    public $fillable=['product_id', 'category_id'];

    public function ProductCategory()
    {
      return $this->belongsToMany('App\Product');
    }

    public function ProductCategory2()
    {
      return $this->belongsToMany('App\Category');
    }

    public function GetRouteKeyName()
    {
      return 'name';
    }
}
