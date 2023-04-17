@extends('layouts.app_new')

@section('content')
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://use.fontawesome.com/b9bdbd120a.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <center>
                    <div class="card-header">{{ __('Register Store Admin') }}</div>
                </center>
                <div class="card-body">
                    <form method="POST" action="{{ url('create') }}">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="form-control" name="action_id" value="{{ Auth::user()->action }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="Address" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pan_card" class="col-md-4 col-form-label text-md-right">{{ __('Pan Card Number') }}</label>
                            <div class="col-md-6">
                                <input id="pan_card" type="text" class="form-control @error('pan_card') is-invalid @enderror" name="pan_card" value="{{ old('pan_card') }}" autocomplete="pan_card" placeholder="Pan_card" autofocus>
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
                                <input id="aadhar_card" type="text" class="form-control @error('aadhar_card') is-invalid @enderror" name="aadhar_card" value="{{ old('aadhar_card') }}" autocomplete="aadhar_card" placeholder="Aadhar Card" autofocus>
                                @error('aadhar_card')
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
                                    <option selected disabled>Select Branch</option>
                                    @foreach($branch as $key => $val)
                                    <option value="{{$val['id']}}">{{$val['branch_name']}} ({{$val['location']}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>
                            <div class="col-md-6">
                                <input id="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autocomplete="mobile_number" placeholder="+91-888-888-8888">
                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email-ID">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-New-password" placeholder="password"> -->
                                <div class="input-group" id="show_hide_password">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-New-password" placeholder="password">
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required autocomplete="new-New-password" placeholder="Confirm Password"> -->
                                <div class="input-group" id="conf_show_hide_password">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="password-confirmation" placeholder="Confirm Password">
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
<script>
$(document).on('click',"#show_hide_password a",function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass( "fa-eye-slash" );
        $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass( "fa-eye-slash" );
        $('#show_hide_password i').addClass( "fa-eye" );
    }
});

$(document).on('click',"#conf_show_hide_password a",function(event) {
    event.preventDefault();
    if($('#conf_show_hide_password input').attr("type") == "text"){
        $('#conf_show_hide_password input').attr('type', 'password');
        $('#conf_show_hide_password i').addClass( "fa-eye-slash" );
        $('#conf_show_hide_password i').removeClass( "fa-eye" );
    }else if($('#conf_show_hide_password input').attr("type") == "password"){
        $('#conf_show_hide_password input').attr('type', 'text');
        $('#conf_show_hide_password i').removeClass( "fa-eye-slash" );
        $('#conf_show_hide_password i').addClass( "fa-eye" );
    }
});
</script>
@endsection