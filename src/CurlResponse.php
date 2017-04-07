<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class CurlResponse implements HttpResponseInterface
{
    private $_headers;
    private $_responseBody;
    private $_status;

    public function __construct($curlResponse)
    {
        $data = explode("\r\n\r\n", $curlResponse);
        $this->_setHeaders($data);
        $this->_responseBody = $data[1];
    }

    public function httpStatus()
    {
        return $this->_status;
    }

    public function parsedResponse()
    {
        $response = json_decode($this->_responseBody);
        if (is_object($response) && count(get_object_vars($response)) === 1) {
            foreach ($response as $item) {
                return $item;
            }
        }
        return $response;
    }

    public function body()
    {
        return $this->_responseBody;
    }

    public function creditLeft()
    {
        return $this->creditLimit() - $this->creditUsed();
    }

    public function creditLimit()
    {
        return (int)explode("/", $this->_bucket())[1];
    }

    private function _bucket()
    {
        return $this->_headers["X-Shopify-Shop-Api-Call-Limit"];
    }

    public function creditUsed()
    {
        return (int)explode("/", $this->_bucket())[0];
    }

    private function _setHeaders($data) {
        $headers = explode("\r\n", $data[0]);
        $statusCodeHeader = explode(" ", $headers[0]);
        $this->_status = (int) $statusCodeHeader[1];
        $this->_headers = [];
        foreach ($headers as $header) {
            $pair = explode(": ", $header);
            if (count($pair) === 2) {
                $this->_headers[$pair[0]] = $pair[1];
            }
        }
    }
}