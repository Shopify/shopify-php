<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetShopnameTooManyPeriods()
    {
        new ShopifyClient("abc", "too.many.periods.myshopify.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetShopnameWithInvalidCharacters()
    {
        new ShopifyClient("abc", "to*&^%$'abc.myshopify.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetShopnameTooShort()
    {
        new ShopifyClient("abc", "abc.myshopify.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetShopnameTooLong()
    {
        $longString = "1234567890abcdefghijklmnopqrstuvwxyz";
        $shopName = $longString . $longString . $longString;
        $this->assertEquals(true, strlen($shopName) > 100);
        new ShopifyClient($shopName, ".myshopify.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetShopnameNotMyshopify()
    {
        new ShopifyClient("abfc3re34wr43f5g2dgf432", "josh.joshstore.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetInvalidAccessToken()
    {
        new ShopifyClient("abc", "040350450399894.myshopify.com");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testRequestOnlyAcceptsValidMethods()
    {
        $client = new ShopifyClient("abc", "040350450399894.myshopify.com");
        $client->call("OPTIONS", "https://040350450399894.myshopify.com/admin/products.json", null, null);
    }

    public function testCall()
    {
        $client = new ShopifyClient("abnini3ruin4ruinc", "040350450399894.myshopify.com");
        $client->setHttpClient(new MockRequest());
        $response = $client->call("PUT", "messages/3094304723/templates", ['test' => 'call'], ['since_id' => 4]);
        $this->assertEquals("PUT", $response[0]);
        $this->assertEquals("https://040350450399894.myshopify.com/admin/messages/3094304723/templates.json", $response[1]);
        $this->assertEquals(['Content-Type: application/json', 'X-Shopify-Access-Token: abnini3ruin4ruinc'], $response[2]);
        $this->assertEquals(['test' => 'call'], $response[3]);
        $this->assertEquals(['since_id' => 4], $response[4]);
    }

    public function testSetShopNameAndAccessToken()
    {
        $client = new ShopifyClient("abnini3ruin4ruinc", "040350450399894.myshopify.com");
        $client->setHttpClient(new MockRequest());
        $client->setShopName('4234322.myshopify.com');
        $response = $client->call("PUT", "messages/3094304723/templates", ['test' => 'call'], ['since_id' => 4]);
        $this->assertEquals("https://4234322.myshopify.com/admin/messages/3094304723/templates.json", $response[1]);
        $this->assertEquals(['Content-Type: application/json', 'X-Shopify-Access-Token: abnini3ruin4ruinc'], $response[2]);
        $client->setAccessToken('xyzrf43f4ff434t43');
        $response = $client->call("PUT", "messages/3094304723/templates", ['test' => 'call'], ['since_id' => 4]);
        $this->assertEquals("https://4234322.myshopify.com/admin/messages/3094304723/templates.json", $response[1]);
        $this->assertEquals(['Content-Type: application/json', 'X-Shopify-Access-Token: xyzrf43f4ff434t43'], $response[2]);
    }
}
