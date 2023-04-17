@extends('layouts.app_new')

@section('content')
<main id="main" class="main">
    <!-- <div style="float: right; margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{url('/scan_product')}}"> Product Scan </a>
    </div> -->
    <div>
        <table id="table_id" 
    class="table table-condensed table-striped table-hover">
            <thead>
                <tr>

                    <th>
                        Category Name
                    </th>
                    <th>
                        Manufacturer Name
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Product Cost
                    </th>
                    <th>
                        Unit Size
                    </th>
                    <th>
                        Requested Quantity
                    </th>
                    <th>
                        Dispatch Quantity
                    </th>
                    <th>
                        Barcode Id
                    </th>
                    <th>
                        Updated Quantity
                    </th>
                    <th>
                        Date and Time
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
                            {{$v['manufacturer_name']}}
                        </td>
                        <td>
                            {{$v['product_name']}}
                        </td>
                        <td>
                            {{$v['prod_price']}}
                        </td>

                        <td>
                            {{$v['unit_name']}}
                        </td>
                        <td>
                            {{$v['required_qty']}}
                        </td>
                        <td>
                            {{$v['provided_qty']}}
                        </td>
                        <td>
                            {{$v['barcode_id']}}
                        </td>
                        <td>
                            {{$v['updated_qty']}}
                        </td>
                        <td>
                          <?php $date = strtotime($v['updated_at']); ?>
                            {{date('Y-m-d H:m:s',strtotime('+330 minutes',$date))}}
                        </td>
                        <td>
                        <button type="button" class="btn btn-info edit" data-toggle="modal" data-target=".bd-example-modal-lg"  row_id="{{$v['id']}}" onclick="viewOrders('{{ $v['barcode_id'] }}','{{$v['id']}}')">Edit</button>
                        <button type="button" class="btn btn-success accepted"  rowid="{{$v['id']}}" onclick="acceptedOrders('{{ $v['provided_qty'] }}','{{$v['id']}}')">Accepted</button>
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
                    <p style="color: #7e8d9f;font-size: 20px;">Barcode ID: #<strong class="order_num"></strong></p>
                  </div>
                 
                  <hr>
                </div>

                <div class="">
                  <div class="row my-2 mx-1 justify-content-center">
                  <div class="form-group row">
                    <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Received Quantity') }}</label>
                    
                    <div class="col-md-6">
                        <input id="qty" type="number" class="form-control qty" name="qty"  required autocomplete="qty">
                        <input id="qty_id" type="hidden" class="form-control qty_id" name="id"  required autocomplete="id">
                        
                    </div>
                    
                </div>
                  </div>
                 
                  <hr>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success submit">Submit</button>  
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
</main><!-- End #main -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>    
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
function viewOrders(order_id,row_id) {
    $('.qty').val('');
    $('.order_num').text(order_id);
    $('.qty_id').val(row_id);
  }
$(document).on('click',".submit",function(event) {
    event.preventDefault();    
    recive_id = $('.qty_id').val();
    qty = $('.qty').val();

    $.ajax({
      url: 'get_recive_id',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        recive_id: recive_id,
        qty: qty
      },
      dataType: 'JSON',
      success: function(data) {
        window.location.reload();
      }
    });
});

function acceptedOrders(qty,row_id) {
    
    $.ajax({
      url: 'get_recive_id',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        recive_id: row_id,
        qty: qty
      },
      dataType: 'JSON',
      success: function(data) {
        window.location.reload();
      }
    });
  }

</script>
@endsection 