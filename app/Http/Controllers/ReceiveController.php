<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Store;
use App\Dispatch;
use App\TBLDispatch;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ReceiveController extends Controller
{

    public function index()
    {
        $data = TBLDispatch::where(['clinic_id'=>Auth::user()->location_id])->orderBy('id', 'DESC')->get();
        
        return view('recive_product_list',compact('data'));
    }

    public function scan_product(Request $requst)
    {   
        return view('receive_product');
    }
    
    public function edit_unit(Request $request)
    {
        $id = $request->id;
        
        $data = Unit::Where(['id' => $id])->first()->toArray();
        
        return view('edit_unit',compact('data'));
    }

    public function set_unit(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['name']));
        $data['is_active'] = 1;
        $data['user_id'] = $request['user_id'];
        $update = Unit::Create($data);
        session()->flash('message', 'Data Add Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return back()->with(['status' =>  'success']);       
    }

    public function update_unit(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = Unit::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/unit')->with(['status' =>  'success']);
    }

    public function get_recive_id(Request $request)
    {
        $qty = $request['qty'];
        $recive_id = $request['recive_id'];
        $data = TBLDispatch::where(['id'=>$recive_id])->Update(['updated_qty'=>$qty]);
        return ['status'=>'success'];
    }
}