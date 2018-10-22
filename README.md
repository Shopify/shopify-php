
# 🚧 Currently Inactive 🚧

[![Build Status](https://travis-ci.org/Shopify/shopify-php.svg?branch=master)](https://travis-ci.org/Shopify/shopify-php) [![codecov](https://codecov.io/gh/Shopify/shopify-php/branch/master/graph/badge.svg)](https://codecov.io/gh/Shopify/shopify-php)

## Installation via [composer](https://getcomposer.org/download/)

```
composer require shopify/shopify-php
```

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
$object = $response->parsedResponse();
```

```php
$orders = $client->orders->readList();
foreach ($order in $orders->parsedResponse()) {
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

--- 

## Testing phpunit

```bash
phpunit
```

## Running PHP CodeSniffer

```bash
./vendor/bin/phpcs ./src/ --standard=PSR2
./vendor/bin/phpcs ./test/ --standard=PSR2
```
