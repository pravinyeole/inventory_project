@extends('layouts.app_new')

@section('content')
<div class="container cnt-margin">
    <div class="row justify-content-center">
        <div class="col-md-12 cm-margin">
            <div class="card">
                <table border="0" class="date-sort" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr>
                            <td>From date:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>To date:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body">
                    <table id="table_id" class="table table-condensed table-striped table-hover stock-inword">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Manufacturer</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Rate</th>
                                <th>Stock Add Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result AS $key => $vl)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ucfirst($vl->pn_name)}}</td>
                                <td>{{ucfirst($vl->category_name)}}</td>
                                <td>{{ucfirst($vl->mn_name)}}</td>
                                <td>{{$vl->qty}}</td>
                                <td>{{$vl->name}}</td>
                                <td>{{$vl->cost}}</td>
                                @php
                                $created_at = (isset($vl->created_at) && $vl->created_at != '')?explode(' ',$vl->created_at):'';
                                $date = (isset($created_at[0]) && $created_at[0] != '')?$created_at[0]:'NA';
                                @endphp
                                <td>{{$date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('child-scripts')
<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[7]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY-MM-DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY-MM-DD'
        });

        // DataTables initialisation
        var table = $('.stock-inword').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();
        });
    });
</script>
@endpush