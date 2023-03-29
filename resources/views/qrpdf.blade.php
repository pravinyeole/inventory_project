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
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">{{$data_new['product_name']}}</h2>
<?php
    $tag = new DNS1D();
    // foreach($data_new['QR_data'] As $key){
        for($i=0;$i<=$data_new['quantity'];){
            // echo $tag->getBarcodeHTML($key, "C93",1,30,'green', true);
            echo '<img src="data:image/png;base64,' . $tag->getBarcodePNG($data_new['QR_data'], 'C93',1,40,array(1,1,1), true) . '" alt="barcode"  style="margin:4px;padding:4px;"  /></n><br>';
            $i++;
        }
    // }
?>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>