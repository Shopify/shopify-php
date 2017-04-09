<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class CurlResponse implements HttpResponseInterface
{
    private $headers;
    private $responseBody;
    private $status;

    public function __construct($curlResponse)
    {
        $data = explode("\r\n\r\n", $curlResponse);
        $this->setHeaders($data);
        $this->responseBody = $data[1];
    }

    public function httpStatus()
    {
        return $this->status;
    }

    public function parsedResponse()
    {
        $response = json_decode($this->responseBody);
        if (is_object($response) && count(get_object_vars($response)) === 1) {
            foreach ($response as $item) {
                return $item;
            }
        }
        return $response;
    }

    public function body()
    {
        return $this->responseBody;
    }

    public function creditLeft()
    {
        return $this->creditLimit() - $this->creditUsed();
    }

    public function creditLimit()
    {
        return (int)explode("/", $this->bucket())[1];
    }

    private function bucket()
    {
        return $this->headers["X-Shopify-Shop-Api-Call-Limit"];
    }

    public function creditUsed()
    {
        return (int)explode("/", $this->bucket())[0];
    }

    private function setHeaders($data)
    {
        $headers = explode("\r\n", $data[0]);
        $statusCodeHeader = explode(" ", $headers[0]);
        $this->status = (int) $statusCodeHeader[1];
        $this->headers = [];
        foreach ($headers as $header) {
            $pair = explode(": ", $header);
            if (count($pair) === 2) {
                $this->headers[$pair[0]] = $pair[1];
            }
        }
    }
}
