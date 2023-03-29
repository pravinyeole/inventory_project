<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Clinic_location extends Model
{
    protected $table = "clinic_location";
    protected $fillable = [
        'id','branch_name','location', 'user_id','is_active'
    ];

    public function location()
    {
        return $this->hasMany('App\User','location_id');
    }
}