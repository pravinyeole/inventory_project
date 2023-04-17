<?php

namespace App;
use App\User;
use App\Category;
use App\Manufacturer;
use Illuminate\Database\Eloquent\Model;

class Product_name extends Model
{
    protected $table = "product_name";
    protected $fillable = [
        'id','name', 'unit_id','category_id','manufracture_id','prod_price','user_id','is_active','usage','photo','description','tags',
    ];

    public function categoryModel()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function ManufacturerModel()
    {
        return $this->belongsTo('App\Manufacturer','manufracture_id');
    }

    public function UnitModel()
    {
        return $this->belongsTo('App\Unit','unit_id');
    }
}