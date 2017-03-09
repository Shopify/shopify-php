<?php
namespace Shopify;

interface HttpRequestInterface
{
    public function request($method, $endpoint, Array $headers = [], $payload = null, Array $parameters = []);
}