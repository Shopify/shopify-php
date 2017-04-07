<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

interface HttpRequestInterface
{
    public function request($method, $endpoint, Array $headers = [], $payload = null, Array $parameters = []);
}