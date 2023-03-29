<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $table = "dispatch";
    protected $fillable = [
        'id','branch_id', 'transfer_by_id', 'qr_code','created_at','updated_at','received_qty'
    ];
}