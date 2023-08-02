@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('update_stock') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                               <select name="category" class="form-select">
                                    @foreach($category as $k => $val)
                                      @if($data['category'] == $val['category_name'])
                                      <option value="{{$val['id']}}" selected>{{$val['category_name']}}</option>
                                      @else
                                      <option value="{{$val['id']}}">{{$val['category_name']}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manufacture_name" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>

                            <div class="col-md-6">
                                <select name="manufacture_name" class="form-select">
                                    @foreach($manu as $k => $val)
                                      @if($data['manufacture_name'] == $val['name'])
                                      <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                      @else
                                      <option value="{{$val['id']}}">{{$val['name']}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Brand/Model Name') }}</label>

                            <div class="col-md-6">
                                <select name="product_name" class="form-select">
                                    @foreach($product_name as $k => $val)
                                      @if($data['product_name'] == $val['name'])
                                      <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                      @else
                                      <option value="{{$val['id']}}">{{$val['name']}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="usage" class="col-md-4 col-form-label text-md-right">{{ __('Usage') }}</label>

                            <div class="col-md-6">
                                <input id="usage" type="text" class="form-control @error('usage') is-invalid @enderror" name="usage" value="{{ $data['usage'] }}" required autocomplete="usage">

                                @error('usage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ $data['qty'] }}" required autocomplete="qty">

                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost Price/Unit') }}</label>

                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $data['cost'] }}" required autocomplete="cost">

                                @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                            <div class="col-md-6">
                               <select name="unit" class="form-select">
                                    @foreach($unit as $k => $val)
                                      @if($data['unit'] == $val)
                                      <option value="{{$val['id']}}" selected>{{$val['name']}}</option>
                                      @else
                                      <option value="{{$val['id']}}">{{$val['name']}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control" name="tags" value="{{ $data['tags'] }}" required autocomplete="tags">
                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}">
                                <input type="hidden" class="form-control" name="old_photo" value="{{ $data['photo'] }}">
                                <img src="{{URL::to('/').'/images/'.$data['photo']}}" alt="{{$data['manufacture_name']}}" style="width: 100px; height: 100px;">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" cols="4">{{$data['description']}} </textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/store-eq')}}"  class="btn btn-primary">
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
