<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Clinic_location;
use App\Product_name;
use App\ClinicOrders;
use App\Store;
use App\TBLDispatch;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use DB;

class HomeController extends Controller
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
        $recive_orders = [];
        if(Auth::user()->action == 1)
        {
            $action = 2;
            $where = ['action' => $action,'status'=>'Active'];
        }
        else{
            $action = 3;
            $where = ['action' => $action,'status'=>'Active','ref_id'=>Auth::user()->id];
            $recive_orders = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'),DB::raw('CONCAT(clinic_location.branch_name,",",clinic_location.location) AS clinic_name'),'manufacturer.name AS mn_name','category.category_name')
            ->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')
            ->leftJoin('clinic_location','clinic_location.id','=','clinic_orders.clinic_id')
            ->leftJoin('manufacturer','manufacturer.id','=','clinic_orders.manfracture_id')
            ->leftJoin('category','category.id','=','clinic_orders.category_id')
            ->where('clinic_orders.order_status',0)
            ->groupBy('clinic_orders.order_id')
            ->orderBy('clinic_orders.id')
            ->get();
        }

        if(Auth::user()->action == 3)
        {
            $location = Clinic_location::Where(['id'=>Auth::user()->location_id])->first();
            $recive_product = TBLDispatch::where(['clinic_id'=>Auth::user()->location_id])->get();
            $my_orders = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.user_id',Auth::user()->id)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
            return view('home',compact('location','recive_product','my_orders'));
            
        }
        else
        {
            $data = Auth::user()->with('Clinic_location')->where($where)->get();
            $all_users = Auth::user()->with('Clinic_location')->where(['action' => 3,'status'=>'Active'])->get();
            $location = Clinic_location::Where(['user_id'=>Auth::user()->id])->get();
            $product = Product_name::with('categoryModel','ManufacturerModel')->Where('is_active',1)->get()->toArray();
            return view('home',compact('data','location','all_users','product','recive_orders'));
        }


        
    }
    public function clinic_details(Request $requst)
    {
        if(Auth::user()->action == 1)
        {
            $action = 2;
            $where = ['action' => $action,'status'=>'Active'];
        }
        else{
            $action = 3;
            $where = ['action' => $action,'ref_id'=>Auth::user()->id];
        }
        $data = Auth::user()->with('Clinic_location')->where($where)->get();
        return view('clinic_details',compact('data'));
    }

    public function add_store(Request $requst)
    {   
        $branch = Clinic_location::Where('user_id',Auth::user()->id)->get();
        return view('auth.register',compact('branch'));
    }
    
    public function edit_details(Request $requst)
    {
        $id = $requst->id;
        
        $data = Auth::user()->with('Clinic_location')->where(['id' => $id])->first()->toArray();
        $branch = Clinic_location::Where('user_id',Auth::user()->id)->get();
        
        return view('auth.edit_register',compact('data','branch'));
    }

    protected function edit_register(Request $requst)
    {
        
        $data['name'] = ucfirst(strtolower($requst['name']));
        $data['address'] = ucfirst(strtolower($requst['address']));
        $data['location_id'] = $requst['location_id'];
        $data['status'] = $requst['status'];
        $data['mobile_number']= $requst['mobile_number'];
        $data['pan_card']=strtoupper(strtolower($requst['pan_card']));
        $data['aadhar_card']=strtoupper(strtolower($requst['aadhar_card']));
        $update = User::where('id',$requst->id)->Update($data);
        session()->flash('message', 'This is a message!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/clinic_details')->with(['status' =>  'success']);
    }

    protected function create(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);


        if($data->action_id == 1)
        {
            $action = 2;
        }
        else{
            $action = 3;
        }
        User::create([
            'name' => ucfirst(strtolower($data->name)),
            'email' => $data->email,
            'address' => ucfirst(strtolower($data->address)),
            'location_id' => $data->location_id,
            'status' => 'Active',
            'action' => $action,
            'mobile_number'=>$data->mobile_number,
            'pan_card'=>(isset($data->pan_card) && $data->pan_card!='' || $data->pan_card!= "NA")? strtoupper(strtolower($data->pan_card)) : "NA",
            'aadhar_card'=>(isset($data->aadhar_card) && $data->aadhar_card!='' || $data->aadhar_card!= "NA")? strtoupper(strtolower($data->aadhar_card)) : "NA",
            'ref_id' => Auth::user()->id,
            'password' => Hash::make($data->password)
        ]);
        return Redirect::to('/clinic_details')->with(['status' =>  'success']);
    }

    public function all_clinc_users(Request $request)
    {
        $data = Auth::user()->where(['action' => 3,'status'=>'Active'])->get();
        return view('clinic_details',compact('data'));
    }
    
}
