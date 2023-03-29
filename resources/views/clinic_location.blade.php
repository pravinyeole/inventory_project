@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_clinic')}}"> Add Clinic Location </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Branch Name
                    </th>
                    <th>
                        Location
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
                            {{$v['branch_name']}}
                        </td>
                        <td>
                            {{$v['location']}}
                        </td>
                        <td>
                            @if($v['is_active'] == 1)
                                Active
                            @else
                                InActive
                            @endif
                        </td>
                        
                        <td>
                            <a class="btn btn-primary edit" href="{{url('edit_location/'.$v['id'])}}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   

@endsection 