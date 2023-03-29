<?php

namespace App;
use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = "manufacturer";
    protected $fillable = [
        'id','name', 'category_id','user_id','is_active'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}