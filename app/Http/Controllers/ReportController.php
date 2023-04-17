<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Store;
use App\Dispatch;
use App\TBLDispatch;
use App\StockUpdateHistory;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function stockInword(){
        $result = StockUpdateHistory::select('stock_update_history.usage','stock_update_history.qty','stock_update_history.cost','ut.name','mn.name AS mn_name','pn.name AS pn_name','ca.category_name','stock_update_history.created_at','stock_update_history.updated_at')
        ->leftJoin('manufacturer AS mn','mn.id','stock_update_history.manufacture_name')
        ->leftJoin('product_name AS pn','pn.id','stock_update_history.product_name')
        ->leftJoin('category AS ca','ca.id','stock_update_history.category')
        ->leftJoin('unit AS ut','ut.id','stock_update_history.unit')
        ->get();
        return view('stockinword',compact('result',(array)$result));
    }

    public function stockOutword(){
        $result = TBLDispatch::select('order_id','unit_name','manufacturer_name AS mn_name','product_name AS pn_name','category_name','tbl_dispatch.created_at','tbl_dispatch.updated_at','prod_price AS cost','provided_qty AS disp_qty','required_qty','cl.branch_name','cl.location')
        ->leftJoin('clinic_location AS cl','cl.id','tbl_dispatch.clinic_id')
        ->get();
        return view('stockoutword',compact('result',(array)$result));
    }
}