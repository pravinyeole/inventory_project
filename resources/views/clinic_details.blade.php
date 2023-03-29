@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_store')}}"> Add Clinic User </a>
    </div>
    <div>
        <table id="table_id" class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Email Id /User Id
                    </th>
                    <th>
                        Branch Name
                    </th>
                    <th>
                        Location
                    </th>
                    <th>
                        Address
                    </th>

                    <th>
                        Contact Number
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
                    <tr style="background-color:<?=($v['status']=='Active')?"":"darkgray";?>">
                        <td>
                            {{$v['name']}}
                        </td>
                        <td>
                            {{$v['email']}}
                        </td>
                        <td>
                            @if(isset($v['Clinic_location']))
                            {{$v['Clinic_location']['branch_name']}}
                            @endif
                        </td>
                        <td>
                            @if(isset($v['Clinic_location']))
                            {{$v['Clinic_location']['location']}}
                            @endif
                        </td>
                        <td>
                            {{$v['address']}}
                        </td>

                        <td>
                            {{$v['mobile_number']}}
                        </td>
                        <td>
                            <button class="btn btn-<?=($v['status']=='Active')?"success":"danger";?>">{{$v['status']}}</button>
                        </td>
                        <td>
                            <a class="btn btn-primary edit" href="{{url('edit_details/'.$v['id'])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
@endsection 