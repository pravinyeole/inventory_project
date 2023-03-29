<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    protected $fillable = [
        'id','category_name', 'user_id','is_active'
    ];

    public function location()
    {
        return $this->hasMany('App\User','location_id');
    }
}