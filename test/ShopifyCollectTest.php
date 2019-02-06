<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyCollectTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'collects', null, []);
        $this->mockClient->collects->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'collects/123', null);
        $this->mockClient->collects->read(123);
    }

    public function testCreate()
    {
        $collect = ["product_id" => 921728736, "collection_id" => 841564295];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'collects', ["collect" => $collect]);
        $this->mockClient->collects->create(["product_id" => 921728736, "collection_id" => 841564295]);
    }

    public function testCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'collects/count', null, ['collection_id' => 123]);
        $this->mockClient->collects->readCount(['collection_id' => 123]);
    }

    public function testCustomCreate()
    {
        $collect = [
            "description" => "The Amazing Franco Plan",
            "price" => 1.0
        ];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'collects/123/extra_suffix', ["collect" => $collect]);
        $this->mockClient->collects->customCreate(
            [
                "description" => "The Amazing Franco Plan",
                "price" => 1.0
            ],
            '123',
            'extra_suffix'
        );
    }
}
