<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyFulfillmentEventTest extends \PHPUnit_Framework_TestCase
{
    private $_mockClient;

    public function setUp()
    {
        $this->_mockClient = $this->getMockBuilder('Shopify\ShopifyClient')
            ->setConstructorArgs(['abc', '040350450399894.myshopify.com'])
            ->getMock();
    }

    public function testReadList()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123/fulfillments/456/events',null, []);
        $this->_mockClient->fulfillment_events->readList(123, 456);
    }

    public function testCreate()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/fulfillments/456/events', ["event" => ["status" => "in_transit"]]);
        $this->_mockClient->fulfillment_events->create(123, 456, ['status' => 'in_transit']);
    }

    public function testDestroy()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('DELETE', 'orders/123/fulfillments/456/events/678',null, null);
        $this->_mockClient->fulfillment_events->destroy(678, 123, 456);
    }

    public function testRead()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123/fulfillments/456/events/678',null, null);
        $this->_mockClient->fulfillment_events->read(678, 123, 456);
    }
}
