<?php
namespace Shopify;

class CurlResponseTest extends \PHPUnit_Framework_TestCase
{
    private $_mockResponse;

    public function setUp()
    {
        $this->_mockResponse = file_get_contents('test/data/create_order_response.txt');
    }

    public function testHttpStatus()
    {
        $response = new CurlResponse($this->_mockResponse);
        $this->assertEquals(201, $response->httpStatus());
    }

    public function testParsedResponse()
    {
        $newResponse = new CurlResponse($this->_mockResponse);
        $object = (object)[
            "id" => 4455820553,
            "email" => "",
            "closed_at" => null,
            "created_at" => "2017-01-16T16:46:24-05:00",
            "updated_at" => "2017-01-16T16:46:24-05:00",
            "number" => 13,
            "note" => null,
            "token" => "3a62258de3dd34c4bf180d3fb63fb299",
            "gateway" => "",
            "test" => false,
            "total_price" => "0.00",
            "subtotal_price" => "0.00",
            "total_weight" => 0,
            "total_tax" => "0.00",
            "taxes_included" => false,
            "currency" => "CAD",
            "financial_status" => "paid",
            "confirmed" => true,
            "total_discounts" => "0.00",
            "total_line_items_price" => "0.00",
            "cart_token" => null,
            "buyer_accepts_marketing" => false,
            "name" => "#1013",
            "referring_site" => null,
            "landing_site" => null,
            "cancelled_at" => null,
            "cancel_reason" => null,
            "total_price_usd" => "0.00",
            "checkout_token" => null,
            "reference" => null,
            "user_id" => null,
            "location_id" => null,
            "source_identifier" => null,
            "source_url" => null,
            "processed_at" => "2017-01-16T16:46:24-05:00",
            "device_id" => null,
            "browser_ip" => null,
            "landing_site_ref" => null,
            "order_number" => 1013,
            "discount_codes" => [],
            "note_attributes" => [],
            "payment_gateway_names" => [],
            "processing_method" => "",
            "checkout_id" => null,
            "source_name" => "1223938",
            "fulfillment_status" => null,
            "tax_lines" => [],
            "tags" => "",
            "contact_email" => null,
            "order_status_url" => null,
            "line_items" => [
                (object)[
                    "id" => 8662293577,
                    "variant_id" => null,
                    "title" => "cool",
                    "quantity" => 0,
                    "price" => "4.00",
                    "grams" => 0,
                    "sku" => null,
                    "variant_title" => null,
                    "vendor" => null,
                    "fulfillment_service" => "manual",
                    "product_id" => null,
                    "requires_shipping" => true,
                    "taxable" => true,
                    "gift_card" => false,
                    "name" => "cool",
                    "variant_inventory_management" => null,
                    "properties" => [],
                    "product_exists" => false,
                    "fulfillable_quantity" => 0,
                    "total_discount" => "0.00",
                    "fulfillment_status" => null,
                    "tax_lines" => []
                ]
            ],
            "shipping_lines" => [],
            "fulfillments" => [],
            "refunds" => []
        ];
        $this->assertEquals($object, $newResponse->parsedResponse());
    }

    public function testJsonSmall()
    {
        $newResponse = new CurlResponse("HTTP/1.1 201 Created\r\nServer: nginx\r\n\r\n{\"count\": 1}", 201);
        $this->assertEquals(1, $newResponse->parsedResponse());
    }

    public function testGetJsonNumerousRootElements()
    {
        $newResponse = new CurlResponse("HTTP/1.1 201 Created\r\nServer: nginx\r\n\r\n{\"count\": 1, \"something_else\": \"cats\"}");
        $this->assertEquals(json_decode('{"count": 1, "something_else": "cats"}'), $newResponse->parsedResponse());
    }

    public function testBody()
    {
        $response = new CurlResponse($this->_mockResponse);
        $rawBody = '{"order":{"id":4455820553,"email":"","closed_at":null,"created_at":"2017-01-16T16:46:24-05:00","updated_at":"2017-01-16T16:46:24-05:00","number":13,"note":null,"token":"3a62258de3dd34c4bf180d3fb63fb299","gateway":"","test":false,"total_price":"0.00","subtotal_price":"0.00","total_weight":0,"total_tax":"0.00","taxes_included":false,"currency":"CAD","financial_status":"paid","confirmed":true,"total_discounts":"0.00","total_line_items_price":"0.00","cart_token":null,"buyer_accepts_marketing":false,"name":"#1013","referring_site":null,"landing_site":null,"cancelled_at":null,"cancel_reason":null,"total_price_usd":"0.00","checkout_token":null,"reference":null,"user_id":null,"location_id":null,"source_identifier":null,"source_url":null,"processed_at":"2017-01-16T16:46:24-05:00","device_id":null,"browser_ip":null,"landing_site_ref":null,"order_number":1013,"discount_codes":[],"note_attributes":[],"payment_gateway_names":[],"processing_method":"","checkout_id":null,"source_name":"1223938","fulfillment_status":null,"tax_lines":[],"tags":"","contact_email":null,"order_status_url":null,"line_items":[{"id":8662293577,"variant_id":null,"title":"cool","quantity":0,"price":"4.00","grams":0,"sku":null,"variant_title":null,"vendor":null,"fulfillment_service":"manual","product_id":null,"requires_shipping":true,"taxable":true,"gift_card":false,"name":"cool","variant_inventory_management":null,"properties":[],"product_exists":false,"fulfillable_quantity":0,"total_discount":"0.00","fulfillment_status":null,"tax_lines":[]}],"shipping_lines":[],"fulfillments":[],"refunds":[]}}';
        $this->assertEquals($rawBody, $response->body());
    }

    public function testCreditLeft()
    {
        $response = new CurlResponse($this->_mockResponse);
        $this->assertEquals(39, $response->creditLeft());
    }

    public function testCreditLimit()
    {
        $response = new CurlResponse($this->_mockResponse);
        $this->assertEquals(40, $response->creditLimit());
    }

    public function testCreditUsed()
    {
        $response = new CurlResponse($this->_mockResponse);
        $this->assertEquals(1, $response->creditUsed());
    }
}