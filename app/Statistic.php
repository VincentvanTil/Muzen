<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistic extends Model
{
  use Searchable;
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  public function toSearchableArray()


  {
  $record = $this->toArray();
    $record = [
      'product_name' => $this->product_name,
      'product_description' => $this->product_description,
      'product_tags.name' => $this->product_tag,
      'color_name' => $this->color_name,
    ];

    return $record;
  }


  protected $fillable=['product_name', 'product_description', 'price'];
  public static function searchproduct($record)
  {
    return self::with('ProductSizing', 'ProductTag','ProductImages')
    ->join('product_categories', 'products.id', '=' , 'product_categories.product_id')
    ->join('categories', 'categories.id' , '=' , 'product_categories.category_id')
    ->join('product_images', 'products.id', '=', 'product_images.product_id')
    ->join('product_tags', 'products.id', '=', 'product_tags.product_id')
    ->join('product_colors', 'products.id', '=', 'product_colors.product_id')
    ->join('colors', 'colors.id', '=', 'product_colors.color_id')
    ->where('products.product_name', 'like', '%' . $record . '%')
    ->orWhere('products.product_description', 'like', '%' . $record . '%')
    ->orWhere('product_tags.name', 'like', '%' . $record . '%')
    ->orWhere('colors.name', 'like', '%' . $record . '%')
    ->paginate(15)->onEachSide(3);
  }

  public function ProductTag()
  {
    return $this->hasOne('App\Product_Tag');
  }
  public function ProductSizing()
  {
    return $this->hasOne('App\Product_Size');
  }
  public function ProductImages()
  {
    return $this->hasOne('App\Product_Image');
  }
  public function ProductPrice()
  {
    return $this->hasOne('App\Order_Detail');
  }

  public function ProductUser()
  {
    return $this->hasOne('App\User');
  }
  public function ProductColors()
  {
    return $this->belongsToMany('App\Color', 'product_colors')
      ->using('App\Pivots\Product_colors');
  }
  public function ProductColor()
  {
    return $this->hasOne('App\Product_Color');
  }
  public function ProductCategories()
  {
    return $this->belongsToMany('App\Category', 'product_categories')
      ->using('App\Pivots\Product_categories');
  }
  public function ProductCategory()
  {
    return $this->hasOne('App\Product_Category');
  }
}
