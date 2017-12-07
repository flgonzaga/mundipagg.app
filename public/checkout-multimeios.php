<?php
require_once '../vendor/autoload.php';
require_once 'auth.php';
require_once 'CheckoutMultiMeios.php';

$mundiCheckout = new CheckoutMundipagg();

$mundiCheckout->setItems('CA123', 105171, 'UK FLAG', 1);
$metadata->id = 'cus_123456';
$mundiCheckout->setCustomer(
	array(
		'name' 		=> 'FREDERIC WIND',
		'email' 	=> 'fred@email.com',
		'type'		=> 'individual',
		'document'	=> '93095135270',
		'metadata'	=> $metadata,
	)
);

$mundiCheckout->setPayments(70000, array(
	'number' 		=> '4024007131429325', 
	'holder_name' 	=> 'FREDERIC WIND', 
	'exp_month' 	=> 1, 
	'exp_year'		=> 18, 
	'cvv'			=> '353'
	), 'AVENGERS', 1);

$mundiCheckout->setPayments(35171, array(
	'number' 		=> '342793631858229', 
	'holder_name' 	=> 'JOHN ENGLISH', 
	'exp_month' 	=> 1, 
	'exp_year'		=> 18, 
	'cvv'			=> '3531'
	), 'AVENGERS', 2);

$request = json_encode($mundiCheckout, JSON_PRETTY_PRINT);

// $response = $client->getOrders()->createOrder(json_decode($request));

// print_r($response);

?>
<!DOCTYPE html>
<html>
<head>
	<title>MundiPagg API - Multimeios Payments</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="col-md-6 well well-lg">
			<?php echo $request; ?>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>