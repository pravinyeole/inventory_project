@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin" >
            <div class="card">
                <div class="card-header">{{ __('Purchase Order') }}</div>
                <div class="messages"></div>
                <div class="card-body">
                    <form method="POST" action="{{ url('insert_category') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group row">
                            <label for="category_id" class="col-md-3 col-form-label text-md-right">{{ __('Category Name') }}</label>
                            <div class="col-md-9">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror reset_select" name="category_id" required>
                                    <option selected disabled> Select Option</option>
                                    @foreach($category AS $ct)
                                    <option value="{{$ct->id}}"> {{$ct->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="manufacturer_id" class="col-md-3 col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                            <div class="col-md-9">
                                <select id="manufacturer_id" class="form-control @error('manufacturer_id') is-invalid @enderror reset_select_two" name="manufacturer_id" required>
                                    <option selected disabled> Select Option</option>
                                </select>
                                @error('manufacturer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_id" class="col-md-3 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            <div class="col-md-9">
                                <select id="product_id" class="form-control @error('product_id') is-invalid @enderror reset_select_two" name="product_id" required>
                                    <option selected disabled> Select Option</option>
                                </select>
                                @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </spa n>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="short_description" class="col-md-3 col-form-label text-md-right">{{ __('Short Description') }}</label>
                            <div class="col-md-9">
                                <input id="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" >
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="product_unit" class="col-form-label text-md-right">{{ __('Product Unit') }}</label>
                                
                                <input type="text" id="product_unit" class="form-control product_unit" readonly>
                                <input type="hidden" id="product_unit_id" class="form-control product_unit_id" name="product_unit" readonly>
                               
                            </div>
                        
                            <!-- <div class="col-md-3">
                                <label for="product_price" class=" col-form-label text-md-right">{{ __('Product Price') }}</label>
                                <input id="product_price" type="text" min="1" class="form-control @error('product_price') is-invalid @enderror make_empty" name="product_price" value="0" required readonly disabled>
                                @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> -->
                            <div class="col-md-3">
                                <label for="product_quntity" class=" col-form-label text-md-right">{{ __('Product Quantity') }}</label>
                                <input id="product_quntity" type="number" min="1" class="form-control @error('product_quntity') is-invalid @enderror make_empty" name="product_quntity" required>
                                @error('product_quntity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="product_total" class=" col-form-label text-md-right">{{ __('Product Total') }}</label>
                                <input id="product_total" type="number" min="1" class="form-control @error('product_total') is-invalid @enderror make_empty" name="product_total" required readonly disabled>
                                @error('product_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> -->
                            <div class="col-md-3">
                            <label for="product_quntity" class=" col-form-label text-md-right"></label>
                                <button type="button" id="add_new_item" class="btn btn-primary" style="margin-top:30px;">Add More Item</button>
                            </div>
                        </div>

                        <table class="table table-condensed table-striped table-hover" id="items_table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <!-- <th>Product Price</th> -->
                                    <th>Product Unit</th>
                                    <th>Product quantity</th>
                                    <!-- <th>Total</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="append_row">
                                <tr><td colspan="5" style="text-align:center">No records</td></tr>
                            </tbody>
                            <!-- <tfoot id="footer_row"><tr><th colspan="3" style="text-align:center">Total</th><th>Rs.0.00</th><th></th></tr></tfoot> -->
                        </table>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4" >
                                <button type="button" class="btn btn-success btn-lg" id="final_submit">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/category')}}" class="btn btn-secondary btn-lg">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('child-scripts')
<script>
var productArray=[];
var messages = $('.messages');
    $(messages).html();
$('#add_new_item').click(function(){
    if($('#category_id').val() == '' || $('#category_id').val() == null){
        $('#category_id').focus();
        return false;
    }
    if($('#manufacturer_id').val() == '' || $('#manufacturer_id').val() == null){
        $('#manufacturer_id').focus();
        return false;
    }
    if($('#product_id').val() == '' || $('#product_id').val() == null){
        $('#product_id').focus();
        return false;
    }
    if($('#product_unit').val() == '' || $('#product_unit').val() == null){
        $('#product_unit').focus();
        return false;
    }
    if($('#manufacturer_id').val() == '' || $('#manufacturer_id').val() == null){
        $('#manufacturer_id').focus();
        return false;
    }
    if($('#product_quntity').val() == '' || $('#product_quntity').val() == null){
        $('#product_quntity').focus();
        return false;
    }


    var prod_details = splitProductDetails($('#product_id').val(),'--');
    var prod_name = $('#product_id').find(":selected").text();
    var prod_id = prod_details[0];
    var unit_id = prod_details[1];
    var category_id = prod_details[2];
    var prod_price = $('#product_price').val();
    var unit_name = $('#product_unit').val();
    var manufacturer_id = $('#manufacturer_id').find(":selected").val();
    var product_quntity = $('#product_quntity').val();
    var prod_total = prod_price*product_quntity;
    // var tb_html = '<tr><th><input type="text" readonly disabled value="'+prod_name+'"></th><th><input type="text" readonly disabled value="'+prod_price+'"></th><th><input type="text" readonly disabled value="'+product_quntity+'"></th><th><input type="text" readonly disabled value="'+prod_total+'"></th></tr>';
    // $('#append_row').append(tb_html);
    productArray = productArray.filter(function(elem) {  
        return elem.itemKey !== prod_name+'_'+prod_id; 
    });
    productArray.push({
        itemKey : prod_name+'_'+prod_id, 
        itemData : {'product_name':prod_name,'product_id':prod_id,'category_id':category_id,'manufracture_id':manufacturer_id,'unit_name':unit_name,'unit_id':unit_id,'prod_price':prod_price,'prodct_qty':product_quntity,'prodct_total':prod_total}
    });
    console.log(productArray);
    $('.product_unit').val('');
    generateTbale();
});
function deleteRow(vg){
    productArray = productArray.filter(function(elem) {  
        return elem.itemKey !== vg; 
    });
    generateTbale();
}
function generateTbale(){
    var tb_html;
    var grand_total = 0.00;
    $.each(productArray, function( index, value ) {
        total = value.itemData.prodct_qty*value.itemData.prod_price;
        grand_total = grand_total + total;
        // tb_html += '<tr><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.product_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.prod_price+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.prodct_qty+'"></th><th><input type="text" class="form-control" readonly disabled value="Rs. '+total+'"></th><th><button type="button" class="btn btn-danger deleteRow" onclick='+"deleteRow('"+value.itemData.product_name+'_'+value.itemData.product_id+"')"+'>Delete</button></th></tr>';

        tb_html += '<tr><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.product_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.unit_name+'"></th><th><input type="text" class="form-control" readonly disabled value="'+value.itemData.prodct_qty+'"></th><th><button type="button" class="btn btn-danger deleteRow" onclick='+"deleteRow('"+value.itemData.product_name+'_'+value.itemData.product_id+"')"+'>Delete</button></th></tr>';
    });
    // var tb_footer_html = '<tr><th colspan="3" style="text-align:center">Total</th><th><input type="text" class="form-control" readonly disabled value="Rs. '+grand_total+'"></th><th></th></tr>';
    $('#append_row').empty();
    $('#append_row').append(tb_html);
    // $('#footer_row').empty();
    // $('#footer_row').append(tb_footer_html);
    $('.make_empty').empty();
    $('.make_empty').val('');
    $('.reset_select').prop('selectedIndex',0);
    $('.reset_select_two').empty();
    $('.reset_select_two').append('<option selected disabled> Select Option</option>');
}

$('#manufacturer_id').change(function(){
    $('#product_id').empty();
    $('#product_id').append('<option selected disabled> Select Option</option>');
    $.ajax({
        url: 'prod_by_category',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            man_id: $(this).val(),
            cat_id: $('#category_id').val(),
        },
        dataType: 'JSON',
        success: function(data) {
            jQuery.each( data, function( i, val ) {
                var vt = val.id+'--'+val.unit_id+'--'+val.category_id+'--'+val.prod_price;
                $('#product_id').append(new Option(val.name, vt)); 
            });    
        }
    });
});
$('#final_submit').click(function(){
    if(productArray.length >= 1){
        $('#final_submit').prop('disabled', true);
        $.ajax({
            url: 'order_final_submit',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,productArray:productArray
            },
            dataType: 'JSON',
            success: function(data) {
                var successHtml = '<div class="alert alert-'+data.status+'">'+
                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ data.message +
                    '</div>';
                $(messages).html(successHtml);
                if(data.status == 'success'){
                    window.setTimeout(function() {
                        window.location.href = 'view_my_orders';
                    }, 2000);
                    $('#final_submit').prop('disabled', true);
                }
            }
        });
    }
});
function splitProductDetails(val,splitby){
    return val.split(splitby);
}
// $('#product_unit').change(function(){
//     var prod_details = splitProductDetails($('#product_id').val(),'--');
//     var prod_id = prod_details[0];
//     // var prod_price = prod_details[3];
//     // $('#product_price').val(prod_price);
//     $.ajax({
//             url: 'price_by_unit_cat_man_clinic',
//             type: 'POST',
//             data: {
//                 _token: CSRF_TOKEN,
//                 man_id: $('#manufacturer_id').val(),
//                 cat_id: $('#category_id').val(),
//                 prod_id: prod_id,
//                 unit_id: $('#product_unit').val(),
//             },
//             dataType: 'JSON',
//             success: function(data) {
//                 $('#product_price').val(data);
//             }
//         });
// });
$('#product_quntity').change(function(){
    var prod_details = splitProductDetails($('#product_id').val(),'--');
    var prod_price = $('#product_price').val();
    var product_quntity = $(this).val();
    $('#product_total').val(prod_price*product_quntity);
});
$('#product_id').change(function(){
    var prod_details = splitProductDetails($(this).val(),'--');
    var prod_id = prod_details[0];
    var unit_id = prod_details[1];
    var category_id = prod_details[2];
    var prod_price = prod_details[3];
    // $('#product_price').val(prod_price);
    $('#product_unit').empty();
    $('#product_unit').append('<option selected disabled> Select Option</option>');
    $.ajax({
        url: 'unit_by_category_man_clinic',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            man_id: $('#manufacturer_id').val(),
            cat_id: $('#category_id').val(),
            prod_id: prod_id,
        },
        dataType: 'JSON',
        success: function(data) {
            // $('#product_unit').val(data.name);
            // jQuery.each( data, function( i, val ) {
            //     $('#product_unit').append(new Option(val.name, val.id)); 
            // });
            $('#product_unit').val(data.data.unit_model.name);
            $('#product_unit_id').val(data.data.unit_model.id);
            $('#product_price').val(data.cost);    
        }
    });
});
$('#category_id').change(function(){
    $('#manufacturer_id').empty();
    $('#manufacturer_id').append('<option selected disabled> Select Option</option>');
    $('#product_id').empty();
    $('#product_id').append('<option selected disabled> Select Option</option>');
    $('.product_unit').val('');
    $.ajax({
        url: 'manufracture_by_category',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            cat_id: $(this).val()
        },
        dataType: 'JSON',
        success: function(data) {
            jQuery.each( data, function( i, val ) {
                $('#manufacturer_id').append(new Option(val.name, val.id)); 
            });    
        }
    });
});
</script>
@endpush