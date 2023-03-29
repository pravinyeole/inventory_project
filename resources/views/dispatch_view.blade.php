@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <!-- <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/add_dispatch')}}"> Add Dispatch </a>
    </div> -->
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        Branch Name
                    </th>
                    <th>
                        Branch Location
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Order Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($dispatch_data as $k =>$v)
                    <tr>
                        <td>
                            {{$v['order_id']}}
                        </td>
                        <td>
                            {{$v['branch_name']}}
                        </td>
                        <td>
                            {{$v['location']}}
                        </td>
                        <td>
                            {{$v['created_at']}}
                        </td>
                        <td>
                        <button type="button" class="btn btn-success">Dispatched</button>
                        </td>
                        <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="viewOrders('<?= $v['order_id'] ?>')">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
                  <!-- <div class="col-xl-3 float-end">
          <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
              class="fas fa-print text-primary"></i> Print</a>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
              class="far fa-file-pdf text-danger"></i> Export</a>
        </div> -->
                  <hr>
                </div>

                <div class="">
                  <!-- <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
              <li class="text-muted">Street, City</li>
              <li class="text-muted">State, Country</li>
              <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#123-456</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Creation Date: </span>Jun 23,2021</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  Unpaid</span></li>
            </ul>
          </div>
        </div> -->

                  <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                      <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Manufracture Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Qty</th>
                          <th scope="col">Unit Price</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody id="product_details">

                      </tbody>

                    </table>
                  </div>
                  <div class="row">
                    <div class="col-xl-8">
                      <!-- <p class="ms-3">Add additional notes and payment information</p> -->

                    </div>
                    <div class="col-xl-4">
                      <ul class="list-unstyled">
                        <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span><span class="sub_total"></span></li>
                        <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span><span class="gst"></span></li>
                      </ul>
                      <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 20px;" class="grand_total"></span></p>
                    </div>
                  </div>
                  <hr>
                  <!-- <div class="row">
          <div class="col-xl-10">
            <p>Thank you for your purchase</p>
          </div>
          <div class="col-xl-2">
            <button type="button" class="btn btn-primary text-capitalize"
              style="background-color:#60bdf3 ;">Pay Now</button>
          </div>
        </div> -->

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
      },
      dataType: 'JSON',
      success: function(data) {
        jQuery.each(data, function(i, val) {
          console.log(data);
          var total = val.price_per_unit * val.product_qty;
          var html = '<tr><th scope="row">' + (i + 1) + '</th><td>' + val.mn_name + '</td><td>' + val.name + '</td><td>' + val.product_qty + ' (' + val.product_unit + ')</td><td>Rs. ' + val.price_per_unit + '</td><td>Rs. ' + total + '</td></tr>';
          $('#product_details').append(html);
          grand_total = total + grand_total;
        });
        $('.sub_total').text('Rs. ' + grand_total);
        $('.gst').text('Rs. 0');
        $('.grand_total').text('Rs. ' + grand_total);
      }
    });
  }
</script>
@endpush