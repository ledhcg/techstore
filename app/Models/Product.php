<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
      'product_name_vi',
      'product_name_ru',
      'product_description_vi',
      'product_description_ru',
      'product_image',
      'product_unit_vi',
      'product_unit_ru',
      'product_price_last',
      'product_price_fix',
      'product_price_discount',
      'category_id',
      'product_status'
    ];

}
