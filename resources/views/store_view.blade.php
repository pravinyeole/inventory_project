@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_stock')}}"> Add Stock </a>
    </div>
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Manufacture Name
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Quantity
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
                            {{$v['mn_name']}}
                        </td>
                        <td>
                            {{$v['pr_name']}}
                        </td>
                        <td>
                            {{$v['category_name']}}
                        </td>
                        <td>
                            {{$v['total_qty']}}
                        </td>
                        <td>
                            @php 
                            $ids_array = explode(',',$v['ids']);
                            $ids = str_replace(',','##',$v['ids']);
                            $ids = base64_encode($ids);
                            @endphp
                            @foreach($ids_array AS $key => $v)
                            <a class="btn btn-primary edit" href="{{url('/edit_stock/'.$v)}}">{{$key+1}}</a>
                            @endforeach
                            <a class="btn btn-success" target="_blank" href="{{url('/view-barcode/'.$ids)}}">Barcode</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   


@endsection 