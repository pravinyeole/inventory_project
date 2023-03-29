@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
                <div class="card-body col-md-6">
                    <form method="POST" action="{{ url('stock_register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <div>
                            <label for="category" class=" col-form-label text-md-right">{{ __('Category') }}</label>
                            <select name="category" id="category" class="form-select">
                                <option value="" disabled selected>Select Option</option>
                                @foreach($category as $k => $val)
                                <option value="{{$val['id']}}">{{$val['category_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="manufacture_name" class=" col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                            <select name="manufacture_name" id="manufacture_name" class="form-select">
                                <option value="" disabled selected>Select Option</option>
                            </select>
                        </div>
                        <div>
                            <label for="product_name" class=" col-form-label text-md-right">{{ __('Product Brand/Model Name') }}</label>
                            <select name="product_name" id="product_name" class="form-select">
                                <option value="" disabled selected>Select Option</option>
                            </select>
                        </div>
                        <div>
                            <label for="unit" class=" col-form-label text-md-right">{{ __('Unit') }}</label>
                            <select name="unit" id="unit" class="form-select">
                                <option value="" disabled selected>Select Unit</option>
                            </select>
                        </div>
                        <div>
                            <label for="cost" class=" col-form-label text-md-right">{{ __('Cost Price/Unit') }}</label>
                            <input id="cost" type="number" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}" required autocomplete="cost">
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="qty" class=" col-form-label text-md-right">{{ __('Quantity') }}</label>
                            <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" required autocomplete="qty">

                            @error('qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="usage" class=" col-form-label text-md-right">{{ __('Usage') }}</label>
                            <input id="usage" type="text" class="form-control @error('usage') is-invalid @enderror" name="usage" value="Usage" required autocomplete="usage">

                            @error('usage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="tags" class=" col-form-label text-md-right">{{ __('Tags') }}</label>
                            <input id="tags" type="text" class="form-control" name="tags" value="Tags" required autocomplete="tags">
                            @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="photo">
                            <label for="photo" class=" col-form-label text-md-right">{{ __('Photo') }}</label>
                            <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}" autocomplete="photo">
                            @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class=" col-form-label text-md-right">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" cols="4"> </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-save-width">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/store-eq')}}" class="btn btn-secondary btn-save-width">
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
    $('#category').change(function() {
        $('#manufacture_name').empty();
        $('#manufacture_name').append('<option selected disabled>Select Option</option>');
        $.ajax({
            url: 'manufracture_by_category',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat_id: $(this).val()
            },
            dataType: 'JSON',
            success: function(data) {
                jQuery.each(data, function(i, val) {
                    $('#manufacture_name').append(new Option(val.name, val.id));
                });
            }
        });
    });
    $('#manufacture_name').change(function() {
        $('#product_name').empty();
        $('#product_name').append('<option selected disabled>Select Option</option>');
        $.ajax({
            url: 'prod_by_category',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                man_id: $(this).val(),
                cat_id: $('#category').val(),
            },
            dataType: 'JSON',
            success: function(data) {
                jQuery.each(data, function(i, val) {
                    // var vt = val.id+'--'+val.unit_id+'--'+val.category_id+'--'+val.prod_price;
                    $('#product_name').append(new Option(val.name, val.id));
                });
            }
        });
    });

    $('#product_name').change(function() {
        $('#unit').empty();
        $('#unit').append('<option selected disabled>Select Option</option>');
        $.ajax({
            url: 'unit_by_category_man',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                man_id: $('#manufacture_name').val(),
                cat_id: $('#category').val(),
                prod_id: $(this).val(),
            },
            dataType: 'JSON',
            success: function(data) {
                jQuery.each(data, function(i, val) {
                    // var vt = val.id+'--'+val.unit_id+'--'+val.category_id+'--'+val.prod_price;
                    $('#unit').append(new Option(val.name, val.id));
                });
            }
        });
    });
    var man_id = $('#manufacture_name').val();
    var product_name = $('#product_name').val();
    var cat_id = $('#category').val();
    var unit = $('#unit').val();
    $('#unit').change(function() {
        if (man_id != '' && product_name != '' && cat_id != '' && unit != '') {
            $.ajax({
                url: 'prod_details_by_unit_cat_man_prod',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    man_id: $('#manufacture_name').val(),
                    cat_id: $('#category').val(),
                    prod_id: $('#product_name').val(),
                    unit_id: $(this).val(),
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#usage').val(data.usage);
                    $('#tags').val(data.tags);
                    $('.photo').css('display', 'none');
                    $('<div><label for="photo" class=" col-form-label text-md-right">Photo</label><img src="images/' + data.photo + '" alt="Product Image"></img></div>').insertAfter('.photo');
                }
            });
        }
    });
</script>
@endpush