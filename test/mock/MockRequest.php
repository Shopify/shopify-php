<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class MockRequest implements HttpRequestInterface
{
    public function request($method, $endpoint, array $headers = [], $payload = null, array $parameters = [])
    {
        return [$method, $endpoint, $headers, $payload, $parameters];
    }
}
