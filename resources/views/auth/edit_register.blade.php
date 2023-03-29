@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{{ session('message') }}</p>
                @endif
                <div class="card-body">
                   
                    <form method="POST" action="{{ route('edit_register') }}">
                        @csrf
                        <input id="name" type="hidden" class="form-control" name="id" value="{{ $data['id'] }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data['name'] }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pan_card" class="col-md-4 col-form-label text-md-right">{{ __('Pan Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="pan_card" type="text" class="form-control @error('pan_card') is-invalid @enderror" name="pan_card" value="{{ $data['pan_card'] }}" autocomplete="pan_card" autofocus>

                                @error('pan_card')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aadhar_card" class="col-md-4 col-form-label text-md-right">{{ __('Aadhar Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="aadhar_card" type="text" class="form-control @error('aadhar_card') is-invalid @enderror" name="aadhar_card" value="{{ $data['aadhar_card'] }}" autocomplete="aadhar_card" autofocus>

                                @error('aadhar_card')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('add') is-invalid @enderror" name="address" value="{{ $data['address'] }}" required autocomplete="add">

                                @error('add')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
         

                        <div class="form-group row">
                            <label for="add" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="location_id" aria-label="Default select">
                                    @foreach($branch as $key => $val)
                                       @if(isset($data['clinic_location']))
                                        @if($val['id'] == $data['clinic_location']['id'])
                                          <option value="{{$val['id']}}" selected>{{$val['branch_name']}} ({{$val['location']}})</option>
                                        @else
                                          <option value="{{$val['id']}}">{{$val['branch_name']}} ({{$val['location']}})</option>
                                        @endif  
                                    @else
                                    <option value="{{$val['id']}}">{{$val['branch_name']}} ({{$val['location']}})</option>
                                    @endif


                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $data['mobile_number'] }}" required autocomplete="mobile_number">

                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="Active" selected>Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
                            </div>
                        </div>
                        


                        <div class="form-group row mb-0" style="margin-top:20px;">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                                <a href="{{url('/clinic_details')}}" class="btn btn-primary">
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
