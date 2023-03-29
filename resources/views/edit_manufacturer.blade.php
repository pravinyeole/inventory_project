@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Manufacturer') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('update_manufacturer') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="form-control" name="tabel_id" value="{{ $data['id'] }}">
                       
                        <div class="form-group row">
                            <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <select class="category_name form-select" name="category_name">
                                    
                                    @foreach($category as $k => $v)
                                        @if($data['category_id'] == $v['id'])
                                            <option value="{{$v['id']}}" selected>{{$v['category_name']}}</option>
                                        @else
                                        <option value="{{$v['id']}}">{{$v['category_name']}}</option>
                                        @endif
                                    @endforeach    
                                </select>
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Manufacturer Name') }}</label>
                            
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
                        </br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{url('/manufacturer')}}"  class="btn btn-primary">
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
