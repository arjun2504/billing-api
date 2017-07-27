<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock_items';

    protected $fillable = [ 'product_code', 'product_name', 'price', 'is_available' ];
}
