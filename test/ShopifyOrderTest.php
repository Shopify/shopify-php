<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyOrderTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'orders', null, []);
        $this->mockClient->orders->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123', null);
        $this->mockClient->orders->read(123);
    }

    public function testCreate()
    {
        $line_item = ["title" => "test", "quantity" => 2, "price" => 4.00];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders', ["order" => ["line_items" => [$line_item]]]);
        $this->mockClient->orders->create(["line_items" => [["title" => "test", "quantity" => 2, "price" => 4.00]]]);
    }

    public function testClose()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/close', []);
        $this->mockClient->orders->close(123);
    }

    public function testOpen()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/open', []);
        $this->mockClient->orders->open(123);
    }

    public function testCancel()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/cancel', ['note' => 'broke in shipping', 'amount' => 10.00]);
        $this->mockClient->orders->cancel(123, ['note' => 'broke in shipping', 'amount' => 10.00]);
    }
}
