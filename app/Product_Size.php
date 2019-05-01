<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
  public $table = 'product_sizes';
  public function Product_Size()
{
  return $this->belongsTo(Product::class);
}
}
