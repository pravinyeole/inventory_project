@extends('layouts.app_new')

@section('content')
<main id="main" class="main" style="">

<div class="pagetitle">
  <h1>Dashboard</h1> 
</div>

@if(Auth::user()->action == 1)
  @include('layouts.dashboard')
@elseif(Auth::user()->action == 2)
  @include('layouts.dashboard1')
@else
  @include('layouts.dashboard2')
@endif
</main>
@endsection
