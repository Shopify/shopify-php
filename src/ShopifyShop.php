<?php
namespace Shopify;

class ShopifyShop extends ShopifyObject
{
    const SINGULAR = "shop";

    public function read()
    {
        return $this->_client->call("GET", self::SINGULAR, null, []);
    }
}