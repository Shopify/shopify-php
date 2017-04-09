<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyShop extends ShopifyObject
{
    const SINGULAR = "shop";

    public function read()
    {
        return $this->client->call("GET", self::SINGULAR, null, []);
    }
}
