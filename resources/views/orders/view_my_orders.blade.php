@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/purchase_order')}}"> Add New Order </a>
    </div>
    <div>
                @if(session()->has('message'))
                    <p class="alert {{ session('alert-class') }}">{!! session('message') !!}</p>
                @endif
        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Products Name/Qty
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Remarks
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($my_orders as $k =>$v)
                    <tr>
                        <td>
                            {{$v['order_id']}}
                        </td>
                        <td>
                            {{$v['created_at']}}
                        </td>
                        <td>
                            {{$v['product_name']}}/{{$v['product_qty']}}
                        </td>
                        <td>
                            {{$v['total_price']}}
                        </td>
                        <td>
                            {{($v['order_status']==0)?'Pending':'Completed'}}
                        </td>
                        <td>
                            {{$v['received_remarks']}}
                        </td>
                        <td>
                            @if($v['order_status']==0)
                                <a class="btn btn-danger" href="{{url('delete_order/'.$v['order_id'])}}" onclick="return confirm('Sure To Delete This Order ?')">Delete</a>
                                @elseif($v['order_status']==1)
                                <a class="btn btn-success">Completed</a>
                            @endif
                            <a class="btn btn-secondary" href="{{url('view_invoice/'.$v['order_id'])}}" target="_blank">Invoice</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   
@endsection 