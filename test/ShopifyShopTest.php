<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyShopTest extends \PHPUnit_Framework_TestCase
{
    public function testRead() {
        $client = new ShopifyClient('ab3fj34oiri23difc', '040350450399894.myshopify.com');
        $client->setHttpClient(new MockRequest());
        $out = $client->shops->read();
        $this->assertEquals($out[0], "GET");
        $this->assertEquals($out[1], "https://040350450399894.myshopify.com/admin/shop.json");
    }
}