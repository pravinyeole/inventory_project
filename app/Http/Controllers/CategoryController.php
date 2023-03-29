<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Clinic_location;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $data = Category::get();
        
        return view('category',compact('data'));
    }

    public function add_category(Request $requst)
    {   
        return view('add_category');
    }
    
    public function edit_category(Request $request)
    {
        $id = $request->id;
        
        $data = Category::Where(['id' => $id])->first()->toArray();
        
        return view('edit_category',compact('data'));
    }

    protected function insert_category(Request $request)
    {
            $data['category_name'] = ucfirst(strtolower($request['category_name']));
            $data['is_active'] = 1;
            $data['user_id'] = $request['user_id'];
            $update = Category::Create($data);
            session()->flash('message', 'Data Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);       
    }

    protected function update_category(Request $request)
    {
        $data['category_name'] = ucfirst(strtolower($request['category_name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = Category::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/category')->with(['status' =>  'success']);
    }
}