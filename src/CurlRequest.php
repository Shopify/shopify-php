<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class CurlRequest implements HttpRequestInterface
{
    public function request($method, $endpoint, Array $headers = [], $payload = null, Array $parameters = [])
    {
        if ($parameters) {
            $endpoint .= "?" . http_build_query($parameters);
        }
        $ch = $this->_curlInit($endpoint);
        if ($payload) {
            $this->_setCurlOpt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }
        if (in_array($method, ["PUT", "DELETE"], true)) {
            $this->_setCurlOpt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        $this->_setCurlOpt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->_setCurlOpt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->_setCurlOpt($ch, CURLOPT_HEADER, 1);
        $response = $this->_execute($ch);
        return new CurlResponse($response);
    }

    protected function _execute($ch) {
        return curl_exec($ch);
    }

    protected function _curlInit($endpoint) {
        return curl_init($endpoint);
    }

    protected function _setCurlOpt($ch, $type, $value) {
        curl_setopt($ch, $type, $value);
    }

}