<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Use_product extends Model
{
    protected $table = "use_product";
    protected $fillable = [
        'id','tbl_dispatch_id', 'use_qty'
    ];
    
}