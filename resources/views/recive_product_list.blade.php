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
                        Requeted Quantity
                    </th>
                    <th>
                        Dispatch Quantity
                    </th>
                    <th>
                        Date and Time
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
                            {{$v['updated_at']}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   
@endsection 