<?php
require_once '../vendor/autoload.php';
require_once 'auth.php';
require_once 'debug.php';

$body = '{
  "type": "order",
  "success_url": "http://sandobox.visualy.com/success",
  "order": {
    "items": [
      {
        "amount": 1000,
        "description": "Test item",
        "quantity": 1
      }]
  },
  "payment_settings": {
    "default_payment_method": "boleto",
    "accepted_payment_methods": ["boleto", "credit_card" ],
    "boleto": {
      "due_at": "2018-01-01"
    },
        "credit_card": {
      "installments": [
        {
          "number": 1,
          "total": 105002
        },
        {
          "number": 2,
          "total": 105002
        }
     ]
   }
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
echo $response->id;

// $url = "https://api.mundipagg.com/checkout/v1/tokens/?appID=" . $publicKey;

// echo " " . debugRequest($url, $body);

?>
