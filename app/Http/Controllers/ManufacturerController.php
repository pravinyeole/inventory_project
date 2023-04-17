<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Manufacturer;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{

    public function index()
    {
        $Category = Category::Where('is_active', 1)->get();
        $data = Manufacturer::with('category')->get();
        return view('add_manufacturer', compact('data', 'Category'));
    }

    public function edit_manufacturer(Request $request)
    {
        $id = $request->id;

        $data = Manufacturer::with('category')->Where(['id' => $id])->first()->toArray();
        $category = Category::Where('is_active', 1)->get();

        return view('edit_manufacturer', compact('data', 'category'));
    }

    public function get_manuf_data(Request $request)
    {
        $data = Manufacturer::with('category')->Where(['category_id' => $request->category_id])->get()->toArray();
        return ['data' => $data];
    }

    public function set_manufacturer(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => ['required'],
            'manufacturer_name' => ['required'],
        ]);
        $data['name'] = ucfirst(strtolower($request['manufacturer_name']));
        $data['category_id'] = $request['category_name'];
        $data['is_active'] = 1;
        $data['user_id'] = $request['user_id'];
        $update = Manufacturer::Create($data);
        session()->flash('message', 'Data Add Successfully!');
        session()->flash('alert-class', 'alert-success');
        return back()->with(['status' =>  'success']);
    }

    public function update_manufacturer(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = Manufacturer::Where('id', $request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!');
        session()->flash('alert-class', 'alert-success');
        return Redirect::to('/manufacturer')->with(['status' =>  'success']);
    }
}
