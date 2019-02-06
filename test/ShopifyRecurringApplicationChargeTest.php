<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyRecurringApplicationChargeTest extends \PHPUnit_Framework_TestCase
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
            ->with('GET', 'recurring_application_charges', null, []);
        $this->mockClient->recurring_application_charges->readList();
    }

    public function testRead()
    {
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('GET', 'recurring_application_charges/123', null);
        $this->mockClient->recurring_application_charges->read(123);
    }

    public function testCreate()
    {
        $recurringCharges = [
            "name" => "The Amazing Franco Plan",
            "price" => 4.00,
            "return_url" => "http://theAmazingFrancoPlan.com",
            "test" => true
        ];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'recurring_application_charges', ["recurring_application_charge" => $recurringCharges]);
        $this->mockClient->recurring_application_charges->create([
            "name" => "The Amazing Franco Plan",
            "price" => 4.00,
            "return_url" => "http://theAmazingFrancoPlan.com",
            "test" => true
        ]);
    }

    public function testCustomCreate()
    {
        $recurringCharges = [
            "description" => "The Amazing Franco Plan",
            "price" => 1.0
        ];
        $this->mockClient->expects($this->once())
            ->method('call')
            ->with('POST', 'recurring_application_charges/123/extra_suffix', ["recurring_application_charge" => $recurringCharges]);
        $this->mockClient->recurring_application_charges->customCreate(
            [
                "description" => "The Amazing Franco Plan",
                "price" => 1.0
            ],
            '123',
            'extra_suffix'
        );
    }
}
