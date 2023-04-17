<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::any('/clinic_details', 'HomeController@clinic_details')->name('clinic_details');
Route::any('/create', 'HomeController@create')->name('create');
Route::any('/add_store', 'HomeController@add_store')->name('add_store');
Route::any('/edit_details/{id?}', 'HomeController@edit_details')->name('edit_details');
Route::any('/edit_register/{id?}', 'HomeController@edit_register')->name('edit_register');
Route::any('/store-eq', 'StoreController@index')->name('store_view');
Route::any('/view-barcode/{id?}', 'StoreController@viewBarcode')->name('view-barcode');
Route::any('/add_stock', 'StoreController@add_stock')->name('add_stock');
Route::any('/stock_register', 'StoreController@stock_register')->name('stock_register');
Route::any('/edit_stock/{id?}', 'StoreController@edit_stock')->name('edit_stock');
Route::any('/update_stock', 'StoreController@update_stock')->name('update_stock');
Route::any('/dispatch', 'DispatchController@index')->name('dispatch');
Route::any('/add_dispatch', 'DispatchController@add_dispatch')->name('add_dispatch');
Route::post('/insert_dispatch', 'DispatchController@insert_dispatch')->name('insert_dispatch');
Route::any('/get_bar_code_data', 'DispatchController@get_bar_code_data')->name('get_bar_code_data');
Route::any('/qrgenerator', 'StoreController@qr_generator')->name('qrgenerator');
Route::any('/clinic', 'ClinicLocationController@index')->name('clinic');
Route::any('/add_clinic', 'ClinicLocationController@add_clinic')->name('add_clinic');
Route::any('/add_location', 'ClinicLocationController@add_location')->name('add_location');
Route::any('/edit_location/{id?}', 'ClinicLocationController@edit_location')->name('edit_location');
Route::any('/update_location', 'ClinicLocationController@update_location')->name('update_location');
Route::any('/category', 'CategoryController@index')->name('category');
Route::any('/add_category', 'CategoryController@add_category')->name('add_category');
Route::any('/insert_category', 'CategoryController@insert_category')->name('insert_category');
Route::any('/update_category', 'CategoryController@update_category')->name('update_category');
Route::any('/edit_category/{id?}', 'CategoryController@edit_category')->name('edit_category');
Route::any('/manufacturer', 'ManufacturerController@index')->name('manufacturer');
// Route::any('/add_manufacturer', 'ManufacturerController@add_manufacturer')->name('add_manufacturer');
Route::any('/insert_manufacturer', 'ManufacturerController@set_manufacturer')->name('insert_manufacturer');
Route::any('/update_manufacturer', 'ManufacturerController@update_manufacturer')->name('update_manufacturer');
Route::any('/edit_manufacturer/{id?}', 'ManufacturerController@edit_manufacturer')->name('edit_manufacturer');
Route::any('/get_manuf_data', 'ManufacturerController@get_manuf_data')->name('get_manuf_data');

Route::any('/product', 'ProductController@index')->name('product');
Route::any('/add_product', 'ProductController@addProduct')->name('add_product');
Route::any('/set_product', 'ProductController@set_product')->name('set_product');
Route::any('/update_product', 'ProductController@update_product')->name('update_product');
Route::any('/edit_product/{id?}', 'ProductController@edit_product')->name('edit_product');
Route::any('/unit', 'UnitController@index')->name('unit');
//Route::any('/add_unit', 'UnitController@add_unit')->name('add_unit');
Route::any('/insert_unit', 'UnitController@set_unit')->name('insert_unit');
Route::any('/update_unit', 'UnitController@update_unit')->name('update_unit');
Route::any('/edit_unit/{id?}', 'UnitController@edit_unit')->name('edit_unit');

Route::any('/product_receive', 'ReceiveController@index')->name('product_receive');
Route::any('/scan_product', 'ReceiveController@scan_product')->name('scan_product');
Route::any('/received_orders', 'OrderController@receivedOrders')->name('received_orders');
Route::any('/purchase_order', 'OrderController@purchaseOrder')->name('purchase_order');

Route::any('/prod_by_category', 'AjaxController@prodByCategory')->name('prod_by_category');
Route::any('/prod_details_by_unit_cat_man_prod', 'AjaxController@prodDetailsByUnitCatManProd')->name('prod_details_by_unit_cat_man_prod');
Route::any('/unit_by_category_man', 'AjaxController@unitByCategoryMan')->name('unit_by_category_man');
Route::any('/price_by_unit_cat_man', 'AjaxController@priceByUnitCatMan')->name('price_by_unit_cat_man');
Route::any('/unit_by_product', 'AjaxController@unitByProduct')->name('unit_by_product');
Route::any('/manufracture_by_category', 'AjaxController@manufractureByCategory')->name('manufracture_by_category');
Route::any('/order_final_submit', 'AjaxController@orderFinalSubmit')->name('order_final_submit');
Route::any('/view_my_orders', 'OrderController@viewMyOrders')->name('view_my_orders');
Route::any('/delete_order/{id?}', 'OrderController@deleteOrder')->name('delete_order');
Route::any('/get_order_by_id', 'OrderController@getOrderById')->name('get_order_by_id');
Route::any('/view_invoice/{id?}', 'OrderController@viewInvoice')->name('view_invoice');
Route::any('/all_clinc_users', 'HomeController@all_clinc_users')->name('all_clinc_users');
Route::any('/stock_details', 'StoreController@stockDetails')->name('stock_details');
Route::any('/unit_by_category_man_clinic', 'AjaxController@unitByCategoryManClinic')->name('unit_by_category_man_clinic');

Route::any('/get_recive_id', 'ReceiveController@get_recive_id')->name('get_recive_id');


Route::any('/stock-inword', 'ReportController@stockInword');
Route::any('/stock-outword', 'ReportController@stockOutword');