<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyClient
{
    private $_accessToken;
    private $_shopName;
    private $_httpClient;

    private static $resources = [
        "order",
        "fulfillment",
        "checkout",
        "fulfillment_event",
        "product",
        "shop",
        "variant"
    ];

    public function __construct($accessToken, $shopName)
    {
        foreach (self::$resources as $resource) {
            $className = 'Shopify\Shopify' . str_replace("_", "", ucwords($resource, "_"));
            $this->{$resource . "s"} = new $className($this);
        }
        $this->setAccessToken($accessToken);
        $this->setShopName($shopName);
        $this->setHttpClient();
    }

    public function setAccessToken($_accessToken)
    {
        if (preg_match('/^([a-zA-Z0-9]{10,100})$/', $_accessToken)===0) {
            throw new \InvalidArgumentException("Access token should be between 10 and 100 letters and numbers");
        }
        $this->_accessToken = $_accessToken;
    }

    public function setShopName($shopName)
    {
        if (!$this->_isValidShopName($shopName)) {
            throw new \InvalidArgumentException(
                'Shop name should be 3-100 letters, numbers, or hyphens e.g. your-store.myshopify.com'
            );
        }
        $this->_shopName = $shopName;
    }

    private function _isValidShopName($shopName)
    {
        if (preg_match('/^[a-zA-Z0-9\-]{3,100}\.myshopify\.(?:com|io)$/', $shopName)) {
            return true;
        }
        return false;
    }

    private function _uriBuilder($resource)
    {
        return "https://" . $this->_shopName . "/admin/" . $resource . ".json";
    }

    private function _authHeaders()
    {
        return [
            "Content-Type: application/json",
            "X-Shopify-Access-Token: " . $this->_accessToken
        ];
    }

    public function call($method, $resource, $payload = null, $parameters = [])
    {
        if (!in_array($method, ["POST", "PUT", "PATCH", "GET", "DELETE", "HEAD"], true)) {
            throw new \InvalidArgumentException("Method not valid");
        }
        return $this->_httpClient->request($method, $this->_uriBuilder($resource), $this->_authHeaders(), $payload, $parameters);
    }

    public function setHttpClient(HttpRequestInterface $client = null)
    {
        $this->_httpClient = ($client ? $client : new CurlRequest());
    }
}