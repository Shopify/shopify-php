
# 🚧 Work in progress 🚧 

[![Build Status](https://travis-ci.org/shopify/shopify-php.svg?branch=master)](https://travis-ci.org/shopify/shopify-php) <a href="https://codeclimate.com/github/shopify/shopify-php/coverage"><img src="https://codeclimate.com/github/shopify/shopify-php/badges/coverage.svg" /></a>

## Getting started

```php
<?php
require 'vendor/autoload.php'; 

use Shopify\ShopifyClient;

$client = new ShopifyClient($access_token, "yourshop.myshopify.com");
$products = $client->products->readList();

```

## Creating orders

```php
$newOrder = ['line_items' => [['title' => 'cool', 'price' => 4]]];
$response = $client->orders->create($newOrder);
```

## Reading orders

```php
$response = $client->orders->read($orderId);
$object = $response->getJson();
```

```php
$orders = $client->orders->readList();
foreach ($order in $orders->getJson()) {
    var_dump($order->id);
}
```

## Updating orders

```php
$response = $client->orders->update($orderId, ["note" => "cool order"]);
```

## Counting open orders

```php
$response = $client->orders->readCount(["status" => "open"]);
```

## Deleting orders

```php
$response = $client->orders->delete($orderId);
```
