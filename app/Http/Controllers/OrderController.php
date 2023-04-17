<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Clinic_location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\ClinicOrders;
use App\Category;
use App\Product_name;
use App\TBLDispatch;
use DB;
use Barryvdh\DomPDF\Facade\PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prodByCategory()
    {
        $data = ClinicOrders::all();
        return view('orders.received_orders',$data);
    }    
    public function receivedOrders(Request $request)
    {
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'),DB::raw('CONCAT(clinic_location.branch_name,",",clinic_location.location) AS clinic_name'),'manufacturer.name AS mn_name','category.category_name')
        ->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')
        ->leftJoin('clinic_location','clinic_location.id','=','clinic_orders.clinic_id')
        ->leftJoin('manufacturer','manufacturer.id','=','clinic_orders.manfracture_id')
        ->leftJoin('category','category.id','=','clinic_orders.category_id')
        ->where('clinic_orders.order_status',0)
        ->groupBy('clinic_orders.order_id')
        ->orderBy('clinic_orders.id')
        ->get();
        return view('orders.received_orders',$data);
    }    
    public function getOrderById(Request $request)
    {
        if(isset($request->view_name) && $request->view_name == "dispatch"){
            $data = TBLDispatch::select('tbl_dispatch.id','order_id','tbl_dispatch.created_at','notes','pn.name','tbl_dispatch.provided_qty','tbl_dispatch.unit_name','manufacturer.name AS mn_name','tbl_dispatch.prod_price')->leftJoin('product_name AS pn','pn.id','=','tbl_dispatch.product_id')
            ->leftJoin('manufacturer','manufacturer.id','=','tbl_dispatch.manufacturer_id')
            ->where('tbl_dispatch.order_id',$request->order_id)->orderBy('tbl_dispatch.id')->get();
            return json_encode($data);
        }else{
            $data = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.product_unit','clinic_orders.created_at','order_status','received_remarks','product_name.name AS product_name','clinic_orders.product_qty AS product_qty','manufacturer.name AS mn_name','product_name.description')
            ->leftJoin('manufacturer','manufacturer.id','=','clinic_orders.manfracture_id')
            ->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.order_id',$request->order_id)->orderBy('clinic_orders.id')->get();
            return json_encode($data);
        }

    }    
    public function viewInvoice($orderId)
    {
        $data = TBLDispatch::select('tbl_dispatch.id','tbl_dispatch.order_id','tbl_dispatch.created_at','tbl_dispatch.prod_price','notes AS received_remarks','product_name.name AS product_name','clinic_location.branch_name','clinic_location.location','manufacturer.name AS mn_name','category.category_name','tbl_dispatch.required_qty','tbl_dispatch.provided_qty')
        ->leftJoin('product_name','product_name.id','=','tbl_dispatch.product_id')
        ->leftJoin('clinic_location','clinic_location.id','=','tbl_dispatch.clinic_id')
        ->leftJoin('manufacturer','manufacturer.id','=','tbl_dispatch.manufacturer_id')
        ->leftJoin('category','category.id','=','tbl_dispatch.category_id')
        ->where('tbl_dispatch.order_id',$orderId)->orderBy('tbl_dispatch.id')->get();
        return view('invoice_pdf',compact('data'));
    }    
    public function purchaseOrder()
    {
        $data['category'] = Category::where('is_active',1)->get();
        return view('orders.purchase_orders',$data);
    }    
    public function viewMyOrders()
    {
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'),DB::raw('SUM(total_price) AS total_price'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.user_id',Auth::user()->id)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
        return view('orders.view_my_orders',$data);
    }    
    public function deleteOrder(Request $request)
    {
        ClinicOrders::where('order_id',$request->id)->delete();
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.user_id',Auth::user()->id)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
        session()->flash('message', 'Order Deleted Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/view_my_orders')->with(['status' =>  'success']);
    }    
}
