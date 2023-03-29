<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "unit";
    protected $fillable = [
        'id','name', 'user_id','is_active'
    ];

}