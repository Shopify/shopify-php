<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class CurlRequest implements HttpRequestInterface
{
    public function request($method, $endpoint, array $headers = [], $payload = null, array $parameters = [])
    {
        if ($parameters) {
            $endpoint .= "?" . http_build_query($parameters);
        }
        $ch = $this->curlInit($endpoint);
        if ($payload) {
            $this->setCurlOpt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }
        if (in_array($method, ["PUT", "DELETE"], true)) {
            $this->setCurlOpt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        $this->setCurlOpt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->setCurlOpt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->setCurlOpt($ch, CURLOPT_HEADER, 1);
        $response = $this->execute($ch);
        return new CurlResponse($response);
    }

    protected function execute($ch)
    {
        return curl_exec($ch);
    }

    protected function curlInit($endpoint)
    {
        return curl_init($endpoint);
    }

    protected function setCurlOpt($ch, $type, $value)
    {
        curl_setopt($ch, $type, $value);
    }
}
