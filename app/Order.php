<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=['ordernumber', 'address_id', 'shipping_method', 'amount'];

    public function OrderDetail()
    {
      return $this->hasOne('App\Order_Detail');
    }
	public function Address() {
		return $this->belongsTo('App\Address');
	}
}
