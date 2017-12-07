<?php
require_once '../vendor/autoload.php';
require_once 'auth.php';
require_once 'debug.php';

$body = '{
  "type": "order",
  "success_url": "http://www.mundipagg.com/success",
  "order": {
    "items": [
      {
        "amount": 1000,
        "description": "Test item",
        "quantity": 1
      }]
  },
  "payment_settings": {
    "default_payment_method": "credit_card",
    "allow_multi_payments" : "true",
    "accepted_payment_methods": ["credit_card" ]
  },
  "customer": {
    "name": "Tony Stark",
    "email": "Tony@mundipagg.com",
    "document": "26224451990",
    "phones": {
      "home_phone": {
        "country_code": "55",
        "area_code": "21",
        "number": "000000000"
      }
    }
  },
  "billing_address": {
    "zip_code": "10166",
    "street": "Park Avenue",
    "number": "200",
    "complement": "8º andar",
    "neighborhood": "Central Malibu",
    "city": "Malibu",
    "state": "CA",
    "country": "US"
  },
  "shippable": true,
  "shipping": {
    "amount": "10",
    "description": "Entrega expressa",
    "recipient_name": "Tony Stark",
    "recipient_phone": "21000000000",
    "address": {
        "zip_code": "22221010",
      "street": "Park Avenue",
      "number": "200",
      "complement": "8º andar",
      "neighborhood": "Central Malibu",
      "city": "Malibu",
      "state": "CA",
      "country": "US"
    }
  }
}';

$response = $client->getTokens()->createToken($publicKey, json_decode($body));

?>
<!DOCTYPE html>
<html>
<head>
	<title>MundiPagg API - Checkout Lightbox</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="col-md-6 well well-lg">
			<a class="btn btn-large btn-default" data-mundicheckout="lightbox" data-mundicheckout-token="<?php echo $response->id; ?>"
data-mundicheckout-default>Pagar</a>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
        (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://checkout.mundipagg.com/lightbox.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'mundipagg-lightbox'));
	</script>
</body>
</html>