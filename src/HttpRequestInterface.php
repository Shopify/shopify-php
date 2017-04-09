<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

interface HttpRequestInterface
{
    public function request($method, $endpoint, array $headers = [], $payload = null, array $parameters = []);
}
