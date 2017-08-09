<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'invoices';
    protected $fillable = ['id', 'sale', 'total_gst', 'total', 'day_seq'];

}
