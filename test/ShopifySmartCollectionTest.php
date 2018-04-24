<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifySmartCollectionTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'smart_collections', null, []);
        $this->mockClient->smart_collections->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'smart_collections/123', null);
        $this->mockClient->smart_collections->read(123);
    }

    public function testCreate()
    {
        $smartCollections = ["title" => "IPods", "rules" => [
            "column" => "title",
            "relation" => "starts_with",
            "condition"=> "iPod"
        ]];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'smart_collections', ["smart_collection" => $smartCollections]);
        $this->mockClient->smart_collections->create(["title" => "IPods", "rules" => [
            "column" => "title",
            "relation" => "starts_with",
            "condition"=> "iPod"
        ]]);
    }

    public function testCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'smart_collections/count', null, ['product_id' => 123]);
        $this->mockClient->smart_collections->readCount(['product_id' => 123]);
    }
}
