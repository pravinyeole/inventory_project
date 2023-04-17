@extends('layouts.app_new')
<style>
    .center{
        text-align:center;
    }
</style>
@section('content')
<main id="main" class="main">
    <div>
        <title>Stock Details</title>
        <table id="table_id" class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th class="center">
                        #
                    </th>
                    <th class="center">
                        Category
                    </th>
                    <th class="center">
                        Manufacture Name
                    </th>
                    <th class="center">
                        Product Name
                    </th>
                    <th class="center">
                        Unit Name
                    </th>
                    <th class="center">
                        Available Quantity
                    </th>
                    <th class="center">
                        Required Quantity
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($data AS $key => $dt)
                    <tr>
                        <td class="center">{{$key+1}}</td>
                        <td class="center">{{$dt->category_name}}</td>
                        <td class="center">{{$dt->mn_name}}</td>
                        <td class="center">{{$dt->pn_name}}</td>
                        <td class="center">{{$dt->un_name}}</td>
                        <td class="center">{{$dt->availabel_qty}}</td>
                        <td class="center">{{$dt->request_qty}}</td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    </div>

</main><!-- End #main -->
   


@endsection 