<?php
namespace Shopify;

class ShopifyProductTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'products', null, []);
        $this->_mockClient->products->readList();
    }

    public function testRead()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'products/123', null);
        $this->_mockClient->products->read(123);
    }

    public function testCreate()
    {
        $product = ["title" => "test", "quantity" => 2, "price" => 4.00];
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'products', ["product" => $product]);
        $this->_mockClient->products->create(["title" => "test", "quantity" => 2, "price" => 4.00]);
    }

    public function testCount()
    {
        $this->_mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'products/count', null, ['collection_id' => 123]);
        $this->_mockClient->products->readCount(['collection_id' => 123]);
    }
}
