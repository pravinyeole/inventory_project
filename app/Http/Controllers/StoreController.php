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
        $data = Store::with('Unit_model','Category_model','Manufacturer_model','Product_model')
        ->Where(['user_id'=>Auth::user()->id,'is_active'=>1])->get();
        $category = Category::get();
        
        return view('store_view',compact('data','category'));
    }
    public function viewBarcode($barcode)
    {
        $data = Store::select('barcode_id')->where(['barcode_id'=>$barcode])->first();
        return view('view-barcode',compact('data'));
    }
    public function clinic_details(Request $requst)
    {
        if(Auth::user()->action == 1)
        {
            $action = 2;
        }
        else{
            $action = 3;
        }
        $data = Auth::user()->where(['action' => $action,'status'=>'Active','ref_id'=>Auth::user()->id])->get();
        
        return view('clinic_details',compact('data'));
    }

    public function add_stock(Request $requst)
    {   
        $category = Category::Where('is_active','1')->get();
        $manu = Manufacturer::Where('is_active','1')->get();
        $product_name = Product_name::Where('is_active','1')->get();
        $unit = Unit::Where('is_active','1')->get();
        return view('stock',compact('category','manu','product_name','unit'));
    }
    
    public function edit_stock(Request $request)
    {
        $id = $request->id;
        $data = Store::with('Unit_model','Category_model','Manufacturer_model','Product_model')->Where(['user_id'=>Auth::user()->id,'id' => $id])->first();
        $category = Category::Where('is_active','1')->get();
        $manu = Manufacturer::Where('is_active','1')->get();
        $product_name = Product_name::Where('is_active','1')->get();
        $unit = Unit::Where('is_active','1')->get();

        return view('edit_stock',compact('data','category','manu','product_name','unit'));
    }

    protected function stock_register(Request $request)
    {
        $image_name = 'no_image.jpg';
        if ($request->hasFile('photo')) 
        {
            $image = $request->file('photo');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/images');
            $image->move($destinationPath, $image_name);
        } 

            $row_data=[];
            // for($i=1;$i<=$request['qty'];$i++){
                // $qr_id = date('ymdhis'.$i);
                $qr_id = date('ymdhis');
                $row_data = array('user_id'=> $request['user_id'],
                        'category'=> ucfirst(strtolower($request['category'])),
                        'manufacture_name'=> ucfirst(strtolower($request['manufacture_name'])),
                        'product_name'=> ucfirst(strtolower($request['product_name'])),
                        'usage'=> ucfirst(strtolower($request['usage'])),
                        'unit'=> ucfirst(strtolower($request['unit'])),
                        'photo'=> $image_name,
                        'qty'=> $request['qty'],
                        'cost'=> $request['cost'],
                        'tags'=> $request['tags'],
                        'description'=> ucfirst(strtolower($request['description'])),
                        'is_active'=> 1,
                        'barcode_id'=> $qr_id,
                        'is_scanned'=> 0,
                        'is_print'=> 0,
                    );
                    StockUpdateHistory::insertGetId($row_data);
                    $row_id = Store::select('id')->where(['category'=>$request['category'],'manufacture_name'=>$request['manufacture_name'],'product_name'=>$request['product_name'],'unit'=>$request['unit']])->first();
                    // print_r($row_data);
                if(isset($row_id->id) && $row_id->id > 0){
                    $data['user_id'] = $request['user_id'];
                    $data['category'] = ucfirst(strtolower($request['category']));
                    $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
                    $data['product_name'] = ucfirst(strtolower($request['product_name']));
                    $data['usage'] = ucfirst(strtolower($request['usage']));
                    $data['unit'] = ucfirst(strtolower($request['unit']));
                    // $data['qty'] = $request['qty'];
                    $data['cost']= $request['cost'];
                    $data['tags'] = $request['tags'];
                    $data['description'] = ucfirst(strtolower($request['description']));  
                    $update = Store::where('id',$row_id->id)->update($data);      
                    $update = Store::where('id',$row_id->id)->increment('qty', $request['qty']);
                    if(isset($update) && $update > 0){
                        session()->flash('message', 'Product Add Successfully!'); 
                        session()->flash('alert-class', 'alert-success');
                        return back()->with(['status' =>  'success']);
                    }
                }else{
                    $update = Store::insertGetId($row_data);
                    if(isset($update) && $update > 0){
                        //$data_new  = ['product_name'=>$request['product_name'],'QR_data'=>$qr_id,'quantity'=>5];
                        // view()->share('data_new',$data_new);
                        // $pdf_file_name = date('y_m_d').'_'.$request['product_name'].'_qrpdf.pdf';
                        // ini_set('max_execution_time', 180);
                        // try {
                        //     // $pdf = PDF::loadView('qrpdf',['data_new' => $data_new])->save(public_path($pdf_file_name));
                            
                        //     $pdf = PDF::loadView('qrpdf', ['data_new' => $data_new]);
        
                        //     Storage::put('public/pdf/'.$pdf_file_name, $pdf->output());
                        //   } catch (\Exception $pdf) {
                          
                        //       return $pdf->getMessage();
                        //   }
                        // $pdf->download('qrpdf.pdf');
                        session()->flash('message', 'Product Add Successfully!'); 
                        session()->flash('alert-class', 'alert-success');
                        return back()->with(['status' =>  'success']);
                    }else{
                        session()->flash('message', 'Opps! Somthing went wrong'); 
                        session()->flash('alert-class', 'alert-danger');
                        return back()->with(['status' =>  'danger']);
                    }
                }    
                //DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
                //array_merge($row_data,$data);
            // }        
    }

    protected function update_stock(Request $request)
    {
        if ($request->hasFile('photo')) 
        {
            $image = $request->file('photo');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/images');
            $image->move($destinationPath, $image_name);
        } 
        else
        {
            $image_name = $request['old_photo'];
        }
        $update = Store::Where('id',$request['tabel_id'])->update(['is_active'=>0]);
        // $row_data=[];
        // for($i=1;$i<=$request['qty'];$i++){
            $data['user_id'] = $request['user_id'];
            $data['category'] = ucfirst(strtolower($request['category']));
            $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
            $data['product_name'] = ucfirst(strtolower($request['product_name']));
            $data['usage'] = ucfirst(strtolower($request['usage']));
            $data['unit'] = ucfirst(strtolower($request['unit']));
            $data['photo'] = $image_name;
            $data['qty'] = $request['qty'];
            $data['cost']= $request['cost'];
            $data['tags'] = $request['tags'];
            $data['description'] = ucfirst(strtolower($request['description']));
            //DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
            // array_push($row_data,$data);
        // }
        Store::Create($data);
        session()->flash('message', 'Product Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/store-eq')->with(['status' =>  'success']);
    }
    function qr_generator(Request $request){
        // ALTER TABLE `store` ADD `barcode_id` BIGINT NOT NULL AFTER `tags`, ADD `is_scanned` TINYINT NOT NULL DEFAULT '0' AFTER `barcode_id`, ADD `is_print` TINYINT NOT NULL DEFAULT '0' AFTER `is_scanned`;
        $j = 10000;
        for($i=1;$i<=$j;$i++){
            $lbl_txt= date('ymdhis'.$i);
            echo DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
        }
    }
    function stockDetails(){
        $data = Store::select('store.qty as qty','ct.category_name','mn.name AS mn_name','pn.name AS pn_name','un.name AS un_name',DB::raw('sum(co.product_qty) AS received_qty'))
                ->leftJoin('category AS ct','ct.id','=','store.category')
                ->leftJoin('manufacturer AS mn','mn.id','=','store.manufacture_name')
                ->leftJoin('product_name AS pn','pn.id','=','store.product_name')
                ->leftJoin('unit AS un','un.id','=','store.unit')
                ->join('clinic_orders AS co',function($join)
                    {
                        $join->on('co.category_id', '=', 'store.category');
                        $join->on('co.manfracture_id','=', 'store.manufacture_name');
                        $join->on('co.product_id','=', 'store.product_name');
                        $join->on('co.product_unit','=', 'store.unit');
                    })
                ->get();
        return view('stock_details',compact('data'));
    }
}