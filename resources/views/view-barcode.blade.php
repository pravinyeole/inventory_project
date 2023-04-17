<!DOCTYPE html>
<html lang="en">
<?php
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
@media print {
    .pageBreak {
        page-break-after: always;
    }
}
</style>
</head>
<body>
    <div class="container mt-5">
<?php
    $tag = new DNS1D();
    foreach($data AS $d){
        // echo $tag->getBarcodeHTML($d->barcode_id, "C93",1,30,'green', true);
        for($i = 1;$i <= $d->qty;){
            echo '<img src="data:image/png;base64,' . $tag->getBarcodePNG($d['barcode_id'], 'C93',1,40,array(1,1,1), true) . '" alt="barcode"  style="margin:4px;padding:4px;"  /></n><br>';
            $i++;
        }
        
    }
            
?>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>


<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
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
        /* height: 11in; */
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

    /* print */
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
</style>

<body>
    <article>
    </article>
</body>

</html>