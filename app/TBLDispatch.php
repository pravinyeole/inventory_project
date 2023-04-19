<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Use_product;

class TBLDispatch extends Model
{
    protected $table = "tbl_dispatch";
    protected $fillable = [
        'id','order_id','barcode_id','category_name','category_id','manufacturer_name','manufacturer_id','product_name','product_id','prod_price','unit_name','unit_id','required_qty','provided_qty','notes','created_at','updated_at'
    ];

    public function index()
    {
        $data = TBLDispatch::where(['clinic_id'=>Auth::user()->location_id])->get();
        return view('recive_product_list',compact('data'));
    }

    public function useProductModel()
    {
        return $this->hasMany('App\Use_product','tbl_dispatch_id');
    }
}