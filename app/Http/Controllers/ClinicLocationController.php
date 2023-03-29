<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Clinic_location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClinicLocationController extends Controller
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
        $data = Clinic_location::Where(['user_id'=>Auth::user()->id])->get();
        
        return view('clinic_location',compact('data'));
    }

    public function add_clinic(Request $requst)
    {   
        return view('add_clinic');
    }
    
    public function edit_location(Request $request)
    {
        $id = $request->id;
        
        $data = Clinic_location::Where(['id' => $id])->first()->toArray();
        
        return view('edit_clinic_location',compact('data'));
    }

    protected function add_location(Request $request)
    {
            $data['branch_name'] = ucfirst(strtolower($request['branch_name']));
            $data['location'] = ucfirst(strtolower($request['location_name']));
            $data['is_active'] = 1;
            $data['user_id'] = $request['user_id'];
            $update = Clinic_location::Create($data);
            session()->flash('message', 'Data Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);
       
    }

    protected function update_location(Request $request)
    {
        $data['branch_name'] = ucfirst(strtolower($request['branch_name']));
        $data['location'] = ucfirst(strtolower($request['location_name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = Clinic_location::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/clinic')->with(['status' =>  'success']);
    }
}