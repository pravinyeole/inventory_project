<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Store;
use App\Category;
use App\Manufacturer;
use App\Product_name;
use App\StockUpdateHistory;
use App\Unit;
use App\ClinicOrders;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
use DB;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data = Store::with('Unit_model', 'Category_model', 'Manufacturer_model', 'Product_model')
        //     ->Where(['user_id' => Auth::user()->id, 'is_active' => 1])->get();
        
        $data = Store::select(DB::raw('GROUP_CONCAT(store.id) AS ids'),DB::raw('GROUP_CONCAT(store.barcode_id) AS group_barcode_id'),DB::raw('GROUP_CONCAT(store.qty) AS group_qty'),DB::raw('SUM(store.qty) AS total_qty'),'c.category_name','pn.name AS pr_name','mn.name AS mn_name')
        ->leftJoin('category AS c','c.id','=','store.category')
        ->leftJoin('product_name AS pn','pn.id','=','store.product_name')
        ->leftJoin('manufacturer AS mn','mn.id','=','store.manufacture_name')
        ->where('store.qty','>',0)
        ->groupBy('store.category','store.manufacture_name','store.product_name')->get();
        // print_r($data);die();
        
        return view('store_view', compact('data'));
    }
    public function viewBarcode($barcode)
    {
        $barcode = base64_decode($barcode);
        $barcode = explode(',',str_replace('##',',',$barcode));
        $data = Store::select('barcode_id','qty')->whereIn('id',($barcode))->get();
        return view('view-barcode', compact('data'));
    }
    public function clinic_details(Request $requst)
    {
        if (Auth::user()->action == 1) {
            $action = 2;
        } else {
            $action = 3;
        }
        $data = Auth::user()->where(['action' => $action, 'status' => 'Active', 'ref_id' => Auth::user()->id])->get();

        return view('clinic_details', compact('data'));
    }

    public function add_stock(Request $requst)
    {
        $category = Category::Where('is_active', '1')->get();
        $manu = Manufacturer::Where('is_active', '1')->get();
        $product_name = Product_name::Where('is_active', '1')->get();
        $unit = Unit::Where('is_active', '1')->get();
        return view('stock', compact('category', 'manu', 'product_name', 'unit'));
    }

    public function edit_stock(Request $request)
    {
        $id = $request->id;
        $data = Store::with('Category_model', 'Manufacturer_model', 'Product_model')->Where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        $category = Category::Where('is_active', '1')->get();
        $manu = Manufacturer::Where('is_active', '1')->get();
        $product_name = Product_name::Where('is_active', '1')->get();
        $unit = Unit::Where('is_active', '1')->get();

        return view('edit_stock', compact('data', 'category', 'manu', 'product_name', 'unit'));
    }

    protected function stock_register(Request $request)
    {
        // For old code check git file Date:30-03-2023
        $image_name = 'no_image.jpg';
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/images');
            $image->move($destinationPath, $image_name);
        }

        $row_data = [];
        if(!empty($request->new_barcode))
        {
            $qr_id = $request->new_barcode;
        }
        else
        {
            $qr_id = date('ymdhis');
        }
        
        $row_data = array(
            'user_id' => $request['user_id'],
            'category' => ucfirst(strtolower($request['category'])),
            'manufacture_name' => ucfirst(strtolower($request['manufacture_name'])),
            'product_name' => ucfirst(strtolower($request['product_name'])),
            'usage' => ucfirst(strtolower((isset($request['usage'])) ? $request['usage'] : "Usages")),
            'unit' => ucfirst(strtolower((isset($request['unit'])) ? $request['unit'] : "unit")),
            'photo' => $image_name,
            'qty' => (isset($request['qty'])) ? $request['qty'] : "qty",
            'cost' => (isset($request['cost'])) ? $request['cost'] : "cost",
            'tags' => (isset($request['tags'])) ? $request['tags'] : "Tags",
            'description' => ucfirst(strtolower((isset($request['description'])) ? $request['description'] : "description")),
            'is_active' => 1,
            'barcode_id' => $qr_id,
            'is_scanned' => 0,
            'is_print' => 0,
        );
        StockUpdateHistory::Create($row_data);
        $insert = Store::Create($row_data);
        if (isset($insert)) {
            session()->flash('message', 'Product Add Successfully!');
            session()->flash('alert-class', 'alert-success');
            return back()->with(['status' =>  'success']);
        } else {
            session()->flash('message', 'Opps! Somthing went wrong');
            session()->flash('alert-class', 'alert-danger');
            return back()->with(['status' =>  'danger']);
        }
    }

    protected function update_stock(Request $request)
    {
        // if ($request->hasFile('photo')) {
        //     $image = $request->file('photo');
        //     $image_name = time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = base_path('public/images');
        //     $image->move($destinationPath, $image_name);
        // } else {
        //     $image_name = $request['old_photo'];
        // }
        $update = Store::Where('id', $request['tabel_id'])->update(['is_active' => 0]);
        // $row_data=[];
        // for($i=1;$i<=$request['qty'];$i++){
        $data['user_id'] = $request['user_id'];
        $data['category'] = ucfirst(strtolower($request['category']));
        $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
        $data['product_name'] = ucfirst(strtolower($request['product_name']));
        // $data['usage'] = ucfirst(strtolower($request['usage']));
        // $data['unit'] = ucfirst(strtolower($request['unit']));
        // $data['photo'] = $image_name;
        $data['qty'] = $request['qty'];
        $data['cost'] = $request['cost'];
        // $data['tags'] = $request['tags'];
        $data['is_active'] = 1;
        // $data['description'] = ucfirst(strtolower($request['description']));
        //DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
        // array_push($row_data,$data);
        // }
        Store::Create($data);
        session()->flash('message', 'Product Update Successfully!');
        session()->flash('alert-class', 'alert-success');
        return Redirect::to('/store-eq')->with(['status' =>  'success']);
    }
    function qr_generator(Request $request)
    {
        // ALTER TABLE `store` ADD `barcode_id` BIGINT NOT NULL AFTER `tags`, ADD `is_scanned` TINYINT NOT NULL DEFAULT '0' AFTER `barcode_id`, ADD `is_print` TINYINT NOT NULL DEFAULT '0' AFTER `is_scanned`;
        $j = 10000;
        for ($i = 1; $i <= $j; $i++) {
            $lbl_txt = date('ymdhis' . $i);
            echo DNS1D::getBarcodeSVG($lbl_txt, "C93", 1, 30, 'green', true);
        }
    }
    function stockDetails()
    {
        // $data = Store::select('store.qty as qty', 'ct.category_name', 'mn.name AS mn_name', 'pn.name AS pn_name', 'un.name AS un_name', DB::raw('sum(co.product_qty) AS received_qty'))
        // ->leftJoin('category AS ct', 'ct.id', '=', 'store.category')
        // ->leftJoin('manufacturer AS mn', 'mn.id', '=', 'store.manufacture_name')
        // ->leftJoin('product_name AS pn', 'pn.id', '=', 'store.product_name')
        // ->leftJoin('unit AS un', 'un.id', '=', 'store.unit')
        // ->leftJoin('clinic_orders AS co', function ($join) {
        //     $join->on('co.category_id', '=', 'store.category');
        //     $join->on('co.manfracture_id', '=', 'store.manufacture_name');
        //     $join->on('co.product_id', '=', 'store.product_name');
        //     $join->on('co.product_unit', '=', 'store.unit');
        // })
        // ->where('co.order_status',1)
        // ->groupBy(['store.product_name','store.unit'])
        // ->get();
        
        // $data_availabel = Store::select('ct.category_name', 'mn.name AS mn_name', 'pn.name AS pn_name', 'un.name AS un_name', DB::raw('sum(store.qty) AS availabel_qty'),DB::raw('select sum(clinic_orders.product_qty) from `clinic_orders` left join `category` as `ct` on `ct`.`id` = `clinic_orders`.`category_id` left join `manufacturer` as `mn` on `mn`.`id` = `clinic_orders`.`manfracture_id` left join `product_name` as `pn` on `pn`.`id` = `clinic_orders`.`product_id` left join `unit` as `un` on `un`.`name` = `clinic_orders`.`product_unit` group by `clinic_orders`.`product_id`, `clinic_orders`.`product_unit` AS request_qty'))
        // ->leftJoin('category AS ct', 'ct.id', '=', 'store.category')
        // ->leftJoin('manufacturer AS mn', 'mn.id', '=', 'store.manufacture_name')
        // ->leftJoin('product_name AS pn', 'pn.id', '=', 'store.product_name')
        // ->leftJoin('unit AS un', 'un.id', '=', 'store.unit')
        // ->groupBy(['store.product_name','store.unit'])
        // ->get();
        //     print_r($data_availabel);
        // die();

        // $data_request = ClinicOrders::select('ct.category_name', 'mn.name AS mn_name', 'pn.name AS pn_name', 'un.name AS un_name', DB::raw('sum(clinic_orders.product_qty) AS request_qty'))
        // ->leftJoin('category AS ct', 'ct.id', '=', 'clinic_orders.category_id')
        // ->leftJoin('manufacturer AS mn', 'mn.id', '=', 'clinic_orders.manfracture_id')
        // ->leftJoin('product_name AS pn', 'pn.id', '=', 'clinic_orders.product_id')
        // ->leftJoin('unit AS un', 'un.name', '=', 'clinic_orders.product_unit')
        // ->groupBy(['clinic_orders.product_id','clinic_orders.product_unit'])
        // ->get();
        
        $data = DB::select('select `ct`.`category_name`, `mn`.`name` as `mn_name`, `pn`.`name` as `pn_name`, `un`.`name` as `un_name`, sum(store.qty) AS availabel_qty,`store`.`category` AS ct_id,`store`.`manufacture_name` AS mn_id,`store`.`product_name` AS pn_id,`store`.`unit` AS u_id from `store` left join `category` as `ct` on `ct`.`id` = `store`.`category` left join `manufacturer` as `mn` on `mn`.`id` = `store`.`manufacture_name` left join `product_name` as `pn` on `pn`.`id` = `store`.`product_name` left join `unit` as `un` on `un`.`id` = `store`.`unit` group by `store`.`product_name`, `store`.`unit`');
        
        // $data_request = DB::select('select `ct`.`category_name`, `mn`.`name` as `mn_name`, `pn`.`name` as `pn_name`, `un`.`name` as `un_name`, sum(clinic_orders.product_qty) AS request_qty from `clinic_orders` left join `category` as `ct` on `ct`.`id` = `clinic_orders`.`category_id` left join `manufacturer` as `mn` on `mn`.`id` = `clinic_orders`.`manfracture_id` left join `product_name` as `pn` on `pn`.`id` = `clinic_orders`.`product_id` left join `unit` as `un` on `un`.`name` = `clinic_orders`.`product_unit` group by `clinic_orders`.`product_id`, `clinic_orders`.`product_unit`');
        if(count($data)){
            foreach($data AS $td){
                $td->category_name = $td->category_name;
                $td->mn_name = $td->mn_name;
                $td->pn_name = $td->pn_name;
                $td->un_name = $td->un_name;
                $td->availabel_qty = $td->availabel_qty;
                $td->request_qty = 0;

                $data_request = DB::select('select sum(product_qty) AS request_qty from `clinic_orders` WHERE product_id='.$td->pn_id.' AND category_id='.$td->ct_id.' AND manfracture_id='.$td->mn_id.' AND product_unit="'.$td->un_name.'" LIMIT 1');
                unset($td->pn_id);
                unset($td->ct_id);
                unset($td->mn_id);
                unset($td->u_id);
                if(count($data_request)){
                    $td->request_qty = $data_request[0]->request_qty;
                }
            }
        }
        // $data = array_combine( (array) $data_availabel, (array)$data_request );
        // $data = array_map("unserialize", array_unique(array_map("serialize", $data)));
        return view('stock_details', compact('data'));
    }
}
