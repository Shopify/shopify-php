<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyProductTest extends \PHPUnit_Framework_TestCase
{
    private $mockClient;

    public function setUp()
    {
        $this->mockClient = $this->getMockBuilder('Shopify\ShopifyClient')
            ->setConstructorArgs(['abc', '040350450399894.myshopify.com'])
            ->getMock();
    }

    public function testReadList()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'products', null, []);
        $this->mockClient->products->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'products/123', null);
        $this->mockClient->products->read(123);
    }

    public function testCreate()
    {
        $product = ["title" => "test", "quantity" => 2, "price" => 4.00];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'products', ["product" => $product]);
        $this->mockClient->products->create(["title" => "test", "quantity" => 2, "price" => 4.00]);
    }

    public function testCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'products/count', null, ['collection_id' => 123]);
        $this->mockClient->products->readCount(['collection_id' => 123]);
    }
}
