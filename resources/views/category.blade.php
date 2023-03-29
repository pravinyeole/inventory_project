@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>
                @if(session()->has('message'))
                <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                    <div class="col-md-4">
                        <form method="POST" action="{{ url('insert_category') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="">
                                <label for="category_name" class="col-form-label text-md-right">{{ __('Category Name') }}</label>
                                    <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" required autocomplete="email">
                                    @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            </br>
                            <div class="form-group row mb-0">
                                <div >
                                    <button type="submit" class="btn btn-primary btn-save-width ">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{url('/category')}}" class="btn btn-secondary btn-save-width">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table id="table_id" class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Category Name
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($data as $k =>$v)
                                <tr>
                                    <td>
                                        {{$v['category_name']}}
                                    </td>
                                    <td>
                                        @if($v['is_active'] == 1)
                                        <button class="btn btn-sucesss">Active</button> 
                                        @else
                                        <button class="btn btn-secondary">InActive</button> 
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-primary edit" href="{{url('edit_category/'.$v['id'])}}">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection