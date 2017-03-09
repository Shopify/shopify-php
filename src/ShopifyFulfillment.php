<?php
namespace Shopify;

class ShopifyFulfillment extends ShopifyObject
{
    const PLURAL = "fulfillments";
    const SINGULAR = "fulfillment";

    use Countable;

    public function readList($orderId = null, Array $options = [])
    {
        return $this->_getList($options, $this->_prefix($orderId));
    }

    public function readCount($orderId, Array $options = [])
    {
        return $this->_getCount($orderId, $options);
    }

    public function read($id, $orderId)
    {
        return $this->_get($id, $this->_prefix($orderId));
    }

    public function create($orderId, $data)
    {
        $this->_post($data, $this->_prefix($orderId));
    }

    public function update($id, $orderId, $data)
    {
        $this->_put($id, $data, $this->_prefix($orderId));
    }

    protected function _prefix($orderId)
    {
        return ShopifyOrder::PLURAL . DIRECTORY_SEPARATOR . $orderId . DIRECTORY_SEPARATOR;
    }
}