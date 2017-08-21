<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyFulfillmentTest extends \PHPUnit_Framework_TestCase
{
    private $mockClient;

    public function setUp()
    {
        $this->mockClient = $this->getMockBuilder('Shopify\ShopifyClient')
            ->setConstructorArgs(['abc', '040350450399894.myshopify.com'])
            ->getMock();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123/fulfillments/456', null, []);
        $this->mockClient->fulfillments->read(456, 123);
    }

    public function testReadList()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123/fulfillments', null, ["since_id" => 456]);
        $this->mockClient->fulfillments->readList(123, ["since_id" => 456]);
    }

    public function testReadCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123/fulfillments/count', null, ["created_at_min" => "2014-04-25T16:15:47-04:00"]);
        $this->mockClient->fulfillments->readCount(123, ["created_at_min" => "2014-04-25T16:15:47-04:00"]);
    }

    public function testCreate()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/fulfillments', ['fulfillment' => ['tracking_number' => 'abc']], []);
        $this->mockClient->fulfillments->create(123, ['tracking_number' => 'abc']);
    }

    public function testUpdate()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('PUT', 'orders/123/fulfillments/456', ['fulfillment' => ['tracking_number' => 'abc']], []);
        $this->mockClient->fulfillments->update(456, 123, ['tracking_number' => 'abc']);
    }
}
