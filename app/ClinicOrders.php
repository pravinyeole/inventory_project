<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ClinicOrders extends Model
{
    protected $table = "clinic_orders";
    protected $fillable = [
        'id','order_id','clinic_id','clinic_location','product_id','category_id','manfracture_id','product_qty','product_unit','price_per_unit','total_price','short_description','order_status','received_status','received_remarks','user_id','created_at','updated_at'];
}