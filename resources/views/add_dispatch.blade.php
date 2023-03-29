@extends('layouts.app_new')

@section('content')
<?php
$all_prod_total = 0.00;
foreach ($order_details as $od) {
    $created_at = $od->created_at;
    $total_price = $od->total_price;
    $name = $od->name;
    $product_qty = $od->product_qty;
    $product_unit = $od->product_unit;
    $price_per_unit = $od->price_per_unit;
    $order_status = $od->order_status;
    $order_id = $od->order_id;
    $clinic_id = $od->clinic_id;
    $branch_name = $od->branch_name;
    $product_total = $od->price_per_unit * $od->product_qty;
    $all_prod_total = $all_prod_total + $product_total;
}
?>
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-left: 180px;">
            <div class="card">
                <div class="card-header" style="text-align:center;"><b>{{ __('Dispatch Order Number ') }}{{$order_details[0]['order_id']}}</b></div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
                <div class="messages"></div>
                <input type="hidden" name="a_barcode_id" id="a_barcode_id">
                <input type="hidden" name="a_category_name" id="a_category_name">
                <input type="hidden" name="a_category_id" id="a_category_id">
                <input type="hidden" name="a_manufacturer_name" id="a_manufacturer_name">
                <input type="hidden" name="a_manufacturer_id" id="a_manufacturer_id">
                <input type="hidden" name="a_product_name" id="a_product_name">
                <input type="hidden" name="a_product_id" id="a_product_id">
                <input type="hidden" name="a_unit_name" id="a_unit_name">
                <input type="hidden" name="a_unit_id" id="a_unit_id">
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="card-header" style="text-align:center;"><b>Order Details</b></div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4">
                                    <label for="category" class="text-md-right">{{ __('Clinic Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="order_date" id="order_date" value="{{$branch_name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4">
                                    <label for="category" class="text-md-right">{{ __('Order Date') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" name="order_date" id="order_date" value="{{$created_at}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4">
                                    <label for="category" class="text-md-right">{{ __('Order Status') }}</label>
                                </div>
                                <div class="col-md-8">
                                    @if($order_status==0)
                                    <button class="btn btn-primary" name="order_status" id="order_status">Pending</button>
                                    @else
                                    <button class="btn btn-success" name="order_status" id="order_status">Completed</button>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Price(Rs.)</th>
                                                <th>Total(Rs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order_details AS $key => $od)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$od->name}}</td>
                                                <td>{{$od->product_unit}}</td>
                                                <td class="requierd_qty_{{$od->product_id}}">{{$od->product_qty}}</td>
                                                <td class="product_price_{{$od->product_id}}">{{$od->price_per_unit}}</td>
                                                <td>{{($od->price_per_unit*$od->product_qty)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <center>SUB-TOTAL</center>
                                                </td>
                                                <td>Rs.{{$all_prod_total}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="ins_disp" name="ins_disp">
                                <div class="form-group row mb-0">
                                    <div class="col-md-4">
                                        <label for="category" class="text-md-right">{{ __('Receiver Name') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <select class="form-control" name="reciver_id" id="reciver_id">
                                            <option disabled selected> Select Name</option>
                                            @foreach($store_list AS $key => $val)
                                            <option value="{{$val->id}}">{{$val->branch_name}}</option>
                                            @endforeach
                                        </select> -->
                                        <input class="form-control" name="reciver_id" id="reciver_id" value="{{$branch_name}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4">
                                        <label for="category" class="text-md-right">{{ __('Scan Barcode') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="barcode_text" id="barcode_text">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Manufacturer</th>
                                                    <th>Prd Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="product_name" id="product_name" disabled readonly><input type="hidden" name="product_id" id="product_id"></td>
                                                    <td><input type="text" class="form-control" name="category_name" id="category_name" disabled readonly></td>
                                                    <td><input type="text" class="form-control" name="name" id="manufacturer_name" disabled readonly></td>
                                                    <td><input type="text" class="form-control" name="prd_unit" id="prd_unit" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="category" class="text-md-right">{{ __('Available Quantity') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="available_qty" id="available_qty" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="category" class="text-md-right">{{ __('Dispatch Quantity') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" min="0" placeholder="0" name="disp_quantity" id="disp_quantity" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-primary btn-submit btn-lg">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row" id="dispatch_details">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Manufacturer Name</th>
                                <th>Product Unit</th>
                                <th>Required Unit</th>
                                <th>Available Unit</th>
                                <th>Price Per Unit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="prod_det_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-primary dispatch-submit btn-lg">{{ __('Submit Dispatch') }}</button>
                            <a href="{{url('/dispatch')}}" class="btn btn-info btn-lg">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('child-scripts')
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var messages = $('.messages');
    $('#dispatch_details').css('display','none');
    var disp_details = [];
    $(messages).html();
    $("#barcode_text").on('keyup', function(e) {
        if ($.isNumeric($(this).val()) && $(this).val().length >= 6) {
            $.ajax({
                url: '/get_bar_code_data',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    _token: CSRF_TOKEN,
                    barcode_text: $(this).val()
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    console.log(data.category_model);
                    $('#product_name').val(data.product_model.name);
                    $('#category_name').val(data.category_model.category_name);
                    $('#prd_unit').val(data.unit_model.name);
                    $('#manufacturer_name').val(data.manufacturer_model.name);
                    $('#available_qty').val(data.qty);
                    $('#disp_quantity').attr('max', data.qty);
                    $('#product_image').attr('src', '/images/' + data.photo);
                    $("#a_barcode_id").val(data.barcode_id);
                    $("#a_category_name").val(data.category_model.category_name);
                    $("#a_category_id").val(data.category_model.id);
                    $("#a_manufacturer_name").val(data.manufacturer_model.name);
                    $("#a_manufacturer_id").val(data.manufacturer_model.id);
                    $("#a_product_name").val(data.product_model.name);
                    $("#a_product_id").val(data.product_model.id);
                    $("#a_unit_name").val(data.unit_model.name);
                    $("#a_unit_id").val(data.unit_model.id);

                }
            });
        }
    });
    $('#disp_quantity').on(('keyup', 'keydown', 'change'), function() {
        if (parseInt($(this).val()) > parseInt($('#available_qty').val())) {
            alert('Available Quantity is less.');
            $(this).val(0);
            return false;
        }
    });
    $(".btn-submit").click(function(e) {
        if($('#disp_quantity').val() > 0){
            var a_barcode_id = $("#a_barcode_id").val();
            var a_category_name = $("#a_category_name").val();
            var a_category_id = $("#a_category_id").val();
            var a_manufacturer_name = $("#a_manufacturer_name").val();
            var a_manufacturer_id = $("#a_manufacturer_id").val();
            var a_product_name = $("#a_product_name").val();
            var a_product_id = $("#a_product_id").val();
            var a_unit_name = $("#a_unit_name").val();
            var a_unit_id = $("#a_unit_id").val();
            disp_details = disp_details.filter(function(elem) {  
                return elem.itemKey !== a_product_name+'_'+a_product_id; 
            });
            disp_details.push({
                itemKey : a_product_name+'_'+a_product_id, 
                itemData : {
                    "order_id":<?php echo $order_id;?>,
                    "barcode_id":a_barcode_id,
                    "category_name":a_category_name,
                    "category_id":a_category_id,
                    "manufacturer_name":a_manufacturer_name,
                    "manufacturer_id":a_manufacturer_id,
                    "product_name":a_product_name,
                    "product_id":a_product_id,
                    "prod_price":$('.product_price_'+a_product_id).text(),
                    "unit_name":a_unit_name,
                    "unit_id":a_unit_id,
                    "required_qty":$('.requierd_qty_'+a_product_id).text(),
                    "provided_qty":$('#disp_quantity').val(),
                    "notes":'NA',
                }
            });
            renderTable();
            $('#product_name').val('');
            $('#category_name').val('');
            $('#prd_unit').val('');
            $('#manufacturer_name').val('');
            $('#available_qty').val('');
            $('#disp_quantity').val('');
            $('#product_image').val('');
            $('#barcode_text').val('');
            $('#barcode_text').focus();
        }else{
            $('html, body').animate({
                scrollTop: $(".container").offset().top
            }, 2000);
            var errorHtml = '<div class="alert alert-danger">Add Dispatch Quantity</div>';
            $(messages).html(errorHtml);
            return false;
        }
    });
    $(".dispatch-submit").click(function(e) {
        $.ajax({
            type: 'POST',
            url: "{{ url('/') }}/insert_dispatch",
            data: {
                _token: CSRF_TOKEN,
                disp_details:disp_details,
            },
            success: function(data) {
                var successHtml = '<div class="alert alert-success">' +
                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> ' + data.message +
                    '</div>';
                    $('html, body').animate({
                    scrollTop: $(".container").offset().top
                }, 2000);
                $(messages).html(successHtml);
                setTimeout(function() {
                    window.location.href = "{{ url('/') }}/dispatch";
                }, 3000);
            },
        });
    });
    function renderTable(){
        var tb_html;
        $.each(disp_details, function( index, value ) {
            total = value.itemData.prodct_qty*value.itemData.prod_price;
            var pname = value.itemData.product_name+"_"+value.itemData.product_id;
            tb_html += '<tr><th>'+(index+1)+'</th><th><input type="text" id="prd_'+value.itemData.product_id+'" class="form-control" readonly disabled value="'+value.itemData.product_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.category_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.manufacturer_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.unit_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.required_qty+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.provided_qty+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.prod_price+'"></th><th><button type="button" class="btn btn-danger deleteItem" onclick="deleteItem('+value.itemData.product_id+')">X</button></th></tr>';
        });
        $('#prod_det_body').empty();
        $('#prod_det_body').append(tb_html);
        if(disp_details.length == 0){
            $('#dispatch_details').css('display','none');
        }else{
            $('#dispatch_details').css('display','block');
        }
    }
    function deleteItem(v){
        var prodcut_name = $('#prd_'+v).val()+'_'+v;
        disp_details = disp_details.filter(function(elem) {  
                return elem.itemKey !== prodcut_name; 
        });
        renderTable();
    }
</script>
@endpush