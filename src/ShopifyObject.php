<?php
namespace Shopify;

class ShopifyObject
{
    protected $_client;

    public function __construct(ShopifyClient $client)
    {
        $this->_client = $client;
    }

    protected function _get($id, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->_client->call("GET", $resource, null, null);
    }

    protected function _getList(Array $options = [], $prefix = '')
    {
        $resource = $prefix . static::PLURAL;
        return $this->_client->call("GET", $resource, null, $options);
    }

    protected function _post($data, $prefix = '')
    {
        $resource = $prefix . static::PLURAL;
        return $this->_client->call("POST", $resource, [static::SINGULAR => $data], []);
    }

    protected function _delete($id, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->_client->call("DELETE", $resource, null, null);
    }

    protected function _put($id, $data, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->_client->call("PUT", $resource, [static::SINGULAR => $data], null);
    }
}