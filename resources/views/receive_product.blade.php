@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dispatch Stock') }}</div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
                <div class="messages"></div>
                <div class="card-body">
                    <form enctype="multipart/form-data" id="ins_disp" name="ins_disp">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Scan Barcode') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="barcode_text" id="barcode_text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Product Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="product_name" id="product_name" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Category Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="category_name" id="category_name" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="manu" class="text-md-right">{{ __('Manufacturer Name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" id="manufacturer_name" disabled readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Unit Size') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="prd_unit" id="prd_unit" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="product_cost" class="text-md-right">{{ __('Product Cost') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="product_cost" id="product_cost" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Receive Quantity') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="disp_quantity" id="disp_quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="category" class="text-md-right">{{ __('Product Image') }}</label>
                            </div>
                            <div class="col-md-8">
                                <img src="" class="form-control" name="product_image" id="product_image"></img>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary btn-submit">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/dispatch')}}" class="btn btn-primary">
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
    var messages = $('.messages');
    $(messages).html();
    $("#barcode_text").on('keyup focus', function(e) {
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
                    $('#product_name').val(data.product_model.name);
                    $('#category_name').val(data.category_model.category_name);
                    $('#prd_unit').val(data.unit_model.name);
                    $('#manufacturer_name').val(data.manufacturer_model.name);
                    $('#available_qty').val(data.qty);
                    $('#product_cost').val(data.cost);
                    $('#product_image').attr('src', '/images/' + data.photo);
                }
            });
        }
    });

    $(".btn-submit").click(function(e){
        var product_name = $('#product_name').val();
        var category_name = $('#category_name').val();
        var prd_unit = $('#prd_unit').val();
        var barcode_text = $('#barcode_text').val();
        var reciver_id = $('#reciver_id').val();
        var available_qty = $('#available_qty').val();
        var disp_quantity = $('#disp_quantity').val();
        if(parseInt(available_qty) >= parseInt(disp_quantity)){
            $.ajax({
                type: 'POST',
                url: "{{ url('/') }}/insert_dispatch",
                data: {_token: CSRF_TOKEN,product_name:product_name,category_name:category_name,prd_unit:prd_unit,available_qty:available_qty,barcode_text:barcode_text,reciver_id:reciver_id,disp_quantity:disp_quantity}, // here $(this) refers to the ajax object not form
                success: function (data) {
                    var successHtml = '<div class="alert alert-success">'+
                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ data.message +
                    '</div>';
                $('html, body').animate({
                    scrollTop: $(".container").offset().top
                }, 9000);
                $(messages).html(successHtml);
                setTimeout(function() {
                    window.location.href = "{{ url('/') }}/dispatch";
                }, 3000);
                },
            });
        }else{
            $('html, body').animate({
                scrollTop: $(".container").offset().top
            }, 9000);
            var errorHtml = '<div class="alert alert-danger">'+
                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong>Dispatch Quantity is greater than availabel quantity</div>';
            $(messages).html(errorHtml);
            return false;
        }
    });
</script>
@endpush