<?php
namespace Shopify;

class MockRequest implements HttpRequestInterface
{
    public function request($method, $endpoint, Array $headers = [], $payload = null, Array $parameters = [])
    {
        return [$method, $endpoint, $headers, $payload, $parameters];
    }
}