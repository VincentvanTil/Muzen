<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table='order_details';
    protected $fillable=['order_id', 'product_id', 'product_price', 'amount'];

    public function Product2()
    {
      return $this->belongsTo(Product::class);
    }
}
