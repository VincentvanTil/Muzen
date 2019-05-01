<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='order_details';
    protected $fillable=['order_id', 'product_id', 'product_price', 'amount'];

    public function Product()
    {
      return $this->belongsTo('App\Product');
    }
}
