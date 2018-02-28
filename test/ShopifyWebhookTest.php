<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyWebhookTest extends \PHPUnit_Framework_Testcase
{
    private $mockClient;

    public function setup()
    {
        $this->mockClient = $this->getMockBuilder('Shopify\ShopifyClient')
            ->setConstructorArgs(['abc', '040350450399894.myshopify.com'])
            ->getMock();
    }

    public function testReadList()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'webhooks', null, []);
        $this->mockClient->webhooks->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'webhooks/123', null);
        $this->mockClient->webhooks->read(123);
    }

    public function testCreate()
    {
        $webhook = ['topic' => 'orders/create', 'address' => 'https://domain.com/webhooks', 'format' => 'json'];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'webhooks', ['webhook' => $webhook]);
        $this->mockClient->webhooks->create(['topic' => 'orders/create', 'address' => 'https://domain.com/webhooks', 'format' => 'json']);
    }

    public function testCount()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'webhooks/count', null, []);
        $this->mockClient->webhooks->readCount();
    }

    public function testUpdate()
    {
        $payload = ['topic' => 'orders/create', 'address' => 'https://domain.com/webhooks', 'format' => 'json'];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('PUT', 'webhooks/1234');
        $this->mockClient->webhooks->update(1234, ['webhook' => $payload], []);
    }

    public function testDelete()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('DELETE', 'webhooks/1234');
        $this->mockClient->webhooks->destroy(1234);
    }
}
