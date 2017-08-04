<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'invoice_products';
    protected $fillable = ['product_code', 'product_name', 'meter', 'quantity', 'rate', 'sale', 'amount_gst', 'amount', 'invoice_id'];
}
