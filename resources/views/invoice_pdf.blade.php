<html>

<head>
    <meta charset="utf-8">
    <title>Challan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>
</head>
<style>
    /* reset */

    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    /* content editable */

    *[] {
        border-radius: 0.25em;
        min-width: 1em;
        outline: 0;
    }

    *[] {
        cursor: pointer;
    }

    *[]:hover,
    *[]:focus,
    td:hover *[],
    td:focus *[],
    img.hover {
        background: #DEF;
        box-shadow: 0 0 1em 0.5em #DEF;
    }

    span {
        display: inline-block;
    }

    /* heading */

    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    /* table */

    table {
        font-size: 75%;
        table-layout: fixed;
        width: 100%;
    }

    table {
        border-collapse: separate;
        border-spacing: 2px;
    }

    th,
    td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
    }

    th,
    td {
        border-radius: 0.25em;
        border-style: solid;
    }

    th {
        background: #EEE;
        border-color: #BBB;
    }

    td {
        border-color: #DDD;
    }

    /* page */

    html {
        font: 16px/1 'Open Sans', sans-serif;
        overflow: auto;
        padding: 0.5in;
    }

    html {
        background: #999;
        cursor: default;
    }

    body {
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        overflow: hidden;
        padding: 0.5in;
        width: 8.5in;
    }

    body {
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    /* header */

    header:after {
        clear: both;
        content: "";
        display: table;
    }

    header h1 {
        background: #000;
        border-radius: 0.25em;
        color: #FFF;
        margin: 0 0 1em;
        padding: 10px;
    }

    header address {
        float: left;
        font-size: 75%;
        font-style: normal;
        line-height: 1.25;
        margin: 0 1em 1em 0;
    }

    header address p {
        margin: 0 0 0.25em;
    }

    header span,
    header img {
        display: block;
        float: right;
    }

    header span {
        margin: 0 0 1em 1em;
        max-height: 25%;
        max-width: 60%;
        position: relative;
    }

    header img {
        max-height: 100%;
        max-width: 100%;
    }

    header input {
        cursor: pointer;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        height: 100%;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 100%;
    }

    /* article */

    article,
    article address,
    table.meta,
    table.inventory {
        margin: 0 0 3em;
    }

    article:after {
        clear: both;
        content: "";
        display: table;
    }

    article h1 {
        clip: rect(0 0 0 0);
        position: absolute;
    }

    article address {
        float: left;
        font-size: 125%;
        font-weight: bold;
    }

    /* table meta & balance */

    table.meta,
    table.balance {
        float: right;
        width: 100%;
    }

    table.meta:after,
    table.balance:after {
        clear: both;
        content: "";
        display: table;
    }

    /* table meta */

    table.meta th {
        width: 40%;
    }

    table.meta td {
        width: 60%;
    }

    /* table items */

    table.inventory {
        clear: both;
        width: 100%;
    }

    table.inventory th {
        font-weight: bold;
        text-align: center;
    }

    table.inventory td:nth-child(1) {
        width: 26%;
    }

    table.inventory td:nth-child(2) {
        width: 38%;
    }

    table.inventory td:nth-child(3) {
        text-align: right;
        width: 12%;
    }

    table.inventory td:nth-child(4) {
        text-align: right;
        width: 12%;
    }

    table.inventory td:nth-child(5) {
        text-align: center;
        width: 12%;
    }

    /* table balance */

    table.balance th,
    table.balance td {
        width: 50%;
    }

    table.balance td,table.balance th {
        text-align: center;
        font-size: large;
        font-weight: bolder;
    }

    /* aside */

    aside h1 {
        border: none;
        border-width: 0 0 1px;
        margin: 0 0 1em;
    }

    aside h1 {
        border-color: #999;
        border-bottom-style: solid;
    }

    /* javascript */

    .add,
    .cut {
        border-width: 1px;
        display: block;
        font-size: .8rem;
        padding: 0.25em 0.5em;
        float: left;
        text-align: center;
        width: 0.6em;
    }

    .add,
    .cut {
        background: #9AF;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
        background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
        border-radius: 0.5em;
        border-color: #0076A3;
        color: #FFF;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
    }

    .add {
        margin: -2.5em 0 0;
    }

    .add:hover {
        background: #00ADEE;
    }

    .cut {
        opacity: 0;
        position: absolute;
        top: 0;
        left: -1.5em;
    }

    .cut {
        -webkit-transition: opacity 100ms ease-in;
    }

    tr:hover .cut {
        opacity: 1;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }

        html {
            background: none;
            padding: 0;
        }

        body {
            box-shadow: none;
            margin: 0;
        }

        span:empty {
            display: none;
        }

        .add,
        .cut {
            display: none;
        }
    }

    @page {
        margin: 0;
    }  
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 100%;
    }
    h4 { 
        display: block;
        font-size: 12px;
        margin-left: 0;
        margin-right: 0;
        font-weight: bold;
    }  
    table tr td{
        text-align: center;
    }
    @media (min-width: 1200px){
        .h1, h1 {
            font-size: 1.5rem !important;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<body>
    <header>
        <h1>Challan</h1>
    </header>
    <article>
        <div class="col-md-12 row">
            <div class="col-md-4">
                <address >
                    <p>Recipient,</p>
                    <p>{{ucfirst($data[0]['branch_name'])}}<br>{{ucfirst($data[0]['location'])}}</p>
                </address>
            </div>
            <div class="col-md-4">
                <span><img src="{{url('img/dental_clinic_logo.jpg')}}" class="center"></span>
            </div>
            <div class="col-md-4">
                <table class="meta">
                    <tr>
                        <th>Invoice #</th>
                        <td>{{$data[0]['order_id']}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{date('F d,Y',strtotime($data[0]['created_at']))}}</td>
                    </tr>
                    <!-- <tr>
                        <th>Amount Due</th>
                        <td><span id="prefix" >$</span>600.00</td>
                    </tr> -->
                </table>
            </div>
        </div>
        <table class="inventory">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Manufacturer</th>
                    <th>Rate</th>
                    <th>Required Quantity</th>
                    <th>Dispatched Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0.00;$grand_total = 0.00; @endphp
                @foreach($data AS $key => $dt)
                    @php
                    $total = $dt->prod_price*$dt->provided_qty;
                    $grand_total = $total+$grand_total;
                    @endphp
                <tr>
                    <td><a class="cut">-</a>{{$dt->product_name}}</td>
                    <td>{{$dt->category_name}}</td>
                    <td>{{$dt->mn_name}}</td>
                    <td><span data-prefix>Rs.{{$dt->prod_price}}</span></td>
                    <td>{{$dt->required_qty}}</td>
                    <td>{{$dt->provided_qty}}</td>
                    <td><span data-prefix>Rs.</span>{{$total}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th>Total</th>
                <td><span data-prefix>Rs.</span><span>{{$grand_total}}</span></td>
            </tr>
        </table>
    </article>
</body>

</html>