<?php
namespace Shopify;

class ShopifyFulfillmentEvent extends ShopifyObject
{
    const PLURAL = "events";
    const SINGULAR = "event";

    public function read($id, $orderId, $fulfillmentId)
    {
        return $this->_get($id, $this->_prefix($orderId, $fulfillmentId));
    }

    public function readList($orderId, $fulfillmentId)
    {
        return $this->_getList([], $this->_prefix($orderId, $fulfillmentId));
    }

    public function create($orderId, $fulfillmentId, Array $data)
    {
        return $this->_post($data, $this->_prefix($orderId, $fulfillmentId));
    }

    public function destroy($id, $orderId, $fulfillmentId)
    {
        return $this->_delete($id, $this->_prefix($orderId, $fulfillmentId));
    }

    protected function _prefix($orderId, $fulfillmentId)
    {
        return join(DIRECTORY_SEPARATOR, [ShopifyOrder::PLURAL, $orderId, ShopifyFulfillment::PLURAL, $fulfillmentId]) . DIRECTORY_SEPARATOR;
    }
}