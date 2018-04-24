<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyCustomCollectionTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'custom_collections', null, []);
        $this->mockClient->custom_collections->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'custom_collections/123', null);
        $this->mockClient->custom_collections->read(123);
    }

    public function testCreate()
    {
        $customCollections = ["title" => "Macbooks"];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'custom_collections', ["custom_collections" => $customCollections]);
        $this->mockClient->custom_collections->create(["title" => "Macbooks"]);
    }

    public function testCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'custom_collections/count', null, ['product_id' => 123]);
        $this->mockClient->custom_collections->readCount(['product_id' => 123]);
    }
}
