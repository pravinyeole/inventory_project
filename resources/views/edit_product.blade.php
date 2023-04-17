@extends('layouts.app_new')
@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Product Name') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('update_product') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="form-control" name="tabel_id" value="{{ $data['id'] }}">
                        <div class="form-group row">
                            <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <select class="category_name form-select" name="category_name" onchange="ManufactureFunction()">
                                    <option value="0">--Select--</option>
                                    @foreach($category as $k => $v)
                                        @if($data['category_id']== $v['id'])
                                        <option value="{{$v['id']}}" selected>{{$v['category_name']}}</option>
                                        @else
                                        <option value="{{$v['id']}}">{{$v['category_name']}}</option>
                                        @endif
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="manufacturer_name" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{$data['manufacturer_model']['name']}}" readonly>
                                <input type="hidden" class="form-control" name="old_manu" value="{{$data['manufracture_id']}}" readonly>
                                <select class="manu_select form-select" name="manu_name">
                                    <option value="0">--Select--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data['name'] }}" required autocomplete="email">

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>
                            <div class="col-md-6">
                                <select name="unit" class="form-select">
                                    @foreach($unit as $k => $val)
                                        @if($data['unit_id'] == $val['id'])
                                            <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                        @else
                                        <option value="{{$val['id']}}">{{$val['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usage" class="col-md-4 col-form-label text-md-right">{{ __('Usage') }}</label>
                            <div class="col-md-6">
                                <input id="usage" type="text" class="form-control @error('usage') is-invalid @enderror" name="usage"  required autocomplete="usage" Placeholder="Usage" value="{{ $data['usage'] }}">

                                @error('usage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>
                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control" name="tags" placeholder="Tags" required autocomplete="tags" value="{{ $data['tags'] }}">
                                
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div  class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" cols="4">{{ $data['description'] }} </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location_name" class="col-md-4 col-form-label text-md-right">{{ __('Action') }}</label>
                            
                            <div class="col-md-6">
                                <select name="is_active" class="form-select">
                                    @if($data['is_active'] == 1)    
                                        <option value="1" selected>Active</option>
                                        <option value="0">In-Active</option>
                                    @else
                                        <option value="1">Active</option>
                                        <option value="0" selected>In-Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}">
                                <input type="hidden" class="form-control" name="old_photo" value="{{ $data['photo'] }}">
                                <img src="{{URL::to('/').'/images/'.$data['photo']}}"  style="width: 300px; height: 100px;">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/product')}}"  class="btn btn-primary">
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function ManufactureFunction()
        {
            var category_name = $('.category_name').val();

            if(category_name != 0)
            {
                $.ajax({
                    url: '/get_manuf_data',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        category_id: category_name
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        var str = '';
                        
                        $.each(data.data, function (i,val) {
                            str+= '<option value="'+val.id+'">'+val.name+'<option>';
                        });
                        
                        $(".manu_select").html(str);
                    }
                });
            }
            else
            {
                alert("Please Select Category");
                return false;
            }            
        }
</script>
@endpush
