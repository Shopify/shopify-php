<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class CurlRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testRequest()
    {
        $stub = $this->
        getMockBuilder('Shopify\CurlRequest')
            ->setMethods(['setCurlOpt', 'execute', 'curlInit'])
            ->getMock();
        $stub->method('execute')->willReturn("HTTP/1.1 201 Created\r\nServer: nginx\r\n\r\n{\"count\": 1}");
        $stub->method('curlInit')->willReturn(123);
        $client = new ShopifyClient('a1b5f44g5y4544252c456', '040350450399894.myshopify.com');
        $client->setHttpClient($stub);
        $stub->expects($this->atLeast(1))->method("curlInit")->with("https://040350450399894.myshopify.com/admin/orders/123.json?created_at_max=2018-04-25T16%3A15%3A47-04%3A00");
        $headers = ['Content-Type: application/json', 'X-Shopify-Access-Token: a1b5f44g5y4544252c456'];
        $stub->expects($this->at(1))->method("setCurlOpt")->with(123, 10015, '{"order":{"note":"special order!"}}');
        $stub->expects($this->at(2))->method("setCurlOpt")->with(123, 10036, 'PUT');
        $stub->expects($this->at(3))->method("setCurlOpt")->with(123, 10023, $headers);
        $stub->expects($this->at(4))->method("setCurlOpt")->with(123, 19913, true);
        $stub->expects($this->at(5))->method("setCurlOpt")->with(123, 42, true);
        $stub->expects($this->once())->method("execute")->with(123);
        $client->call("PUT", "orders/123", ['order' => ['note' => 'special order!']], ['created_at_max' => '2018-04-25T16:15:47-04:00']);
    }
}
