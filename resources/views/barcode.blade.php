<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Barcode Generator </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
  
<body>
    <h1 class="text-primary" style="text-align: center;margin-bottom: 20px;">Laravel Barcode Generator </h1>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('12345678', 'C128',2,44,array(1,1,1),true)}}" alt="barcode" /><br><br>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('11', 'C39')}}" alt="barcode" /><br><br>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('123456789', 'C39+',1,33,array(0,255,0), true)}}" alt="barcode" /><br><br>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('4', 'C39+',3,33,array(255,0,0))}}" alt="barcode" /><br><br>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('12', 'C39+')}}" alt="barcode" /><br><br>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('23', 'POSTNET')}}" alt="barcode" /><br/><br/>
	</div>
</body>
</html>