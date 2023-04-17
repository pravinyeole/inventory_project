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
                    <!-- <th>
                        Products Name/Qty
                    </th> -->
                    <!-- <th>
                        Amount
                    </th> -->
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
                        <!-- <td>
                            {{$v['product_name']}}/{{$v['product_qty']}}
                        </td> -->
                        <!-- <td>
                            {{$v['total_price']}}
                        </td> -->
                        <td>
                            {{($v['order_status']==0)?'Pending':'Completed'}}
                        </td>
                        <td>
                            {{$v['received_remarks']}}
                        </td>
                        <td>
                            @if($v['order_status']==0)
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="viewOrders('<?= $v['order_id'] ?>')">View</button>
                                <a class="btn btn-danger" href="{{url('delete_order/'.$v['order_id'])}}" onclick="return confirm('Sure To Delete This Order ?')">Delete</a>
                                @elseif($v['order_status']==1)
                                <a class="btn btn-success">Completed</a>
                                <a class="btn btn-secondary" href="{{url('view_invoice/'.$v['order_id'])}}" target="_blank">Invoice</a>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main><!-- End #main -->
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class=" mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                  <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice ID: #<strong class="order_num">123-123</strong></p>
                  </div>
                  <hr>
                </div>
                <div class="">
                  <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                      <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Manufracture</th>
                          <th scope="col">Product</th>
                          <th scope="col">Description</th>
                          <th scope="col">Qty</th>
                          <th scope="col">Unit</th>
                          <!-- <th scope="col">Qty</th>
                          <th scope="col">Amount</th> -->
                        </tr>
                      </thead>
                      <tbody id="product_details">
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-xl-8">
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</main><!-- End #main --> 
@endsection 
@push('child-scripts')
<script>
  function viewOrders(order_id) {
    $('#product_details').empty();
    $('.order_num').text(order_id);
    var grand_total = 0;
    $.ajax({
      url: 'get_order_by_id',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        order_id: order_id,
        view_name: "recive_orders",
      },
      dataType: 'JSON',
      success: function(data) {
        jQuery.each(data, function(i, val) {
          var total = val.price_per_unit * val.product_qty;
          // var html = '<tr><th scope="row">' + (i + 1) + '</th><td>' + val.mn_name + '</td><td>' + val.product_name + '</td><td>' + val.product_qty + ' (' + val.product_unit + ')</td><td>Rs. ' + val.price_per_unit + '</td><td>Rs. ' + total + '</td></tr>';
          var html = '<tr><td scope="row">' + (i + 1) + '</td><td>' + val.mn_name + '</td><td>' + val.product_name + '</td><td>' + val.description + '</td><td>' + val.product_qty + '</td><td>' + val.product_unit + '</td></tr>';
          $('#product_details').append(html);
          grand_total = total + grand_total;
        });
        // $('.sub_total').text('Rs. ' + grand_total);
        // $('.gst').text('Rs. 0');
        // $('.grand_total').text('Rs. ' + grand_total);
      }
    });
  }
</script>
@endpush