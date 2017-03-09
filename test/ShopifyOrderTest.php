<?php
namespace Shopify;

class ShopifyOrderTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'orders', null, []);
        $this->_mockClient->orders->readList();
    }

    public function testRead()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'orders/123', null);
        $this->_mockClient->orders->read(123);
    }

    public function testCreate()
    {
        $line_item = ["title" => "test", "quantity" => 2, "price" => 4.00];
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders', ["order" => ["line_items" => [$line_item]]]);
        $this->_mockClient->orders->create(["line_items" => [["title" => "test", "quantity" => 2, "price" => 4.00]]]);
    }

    public function testClose()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/close', []);
        $this->_mockClient->orders->close(123);
    }

    public function testOpen()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/open', []);
        $this->_mockClient->orders->open(123);
    }

    public function testCancel()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'orders/123/cancel', ['note' => 'broke in shipping', 'amount' => 10.00]);
        $this->_mockClient->orders->cancel(123, ['note' => 'broke in shipping', 'amount' => 10.00]);
    }

}
