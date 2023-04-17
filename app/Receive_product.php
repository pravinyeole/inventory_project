<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receive_product extends Model
{
    protected $table = "receive_product";
    protected $fillable = [
        'id','barcode', 'qty', 'product_name','created_at','updated_at','category_name','manufacturer_name','unit_name','cost','branch_id','user_id','updated_qty'
    ];

}