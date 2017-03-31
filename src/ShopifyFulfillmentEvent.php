<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyFulfillmentEvent extends ShopifyObject
{
    const PLURAL = "events";
    const SINGULAR = "event";

    public function read($id, $orderId, $fulfillmentId)
    {
        return $this->get($id, $this->prefix($orderId, $fulfillmentId));
    }

    public function readList($orderId, $fulfillmentId)
    {
        return $this->getList([], $this->prefix($orderId, $fulfillmentId));
    }

    public function create($orderId, $fulfillmentId, array $data)
    {
        return $this->post($data, $this->prefix($orderId, $fulfillmentId));
    }

    public function destroy($id, $orderId, $fulfillmentId)
    {
        return $this->delete($id, $this->prefix($orderId, $fulfillmentId));
    }

    protected function prefix($orderId, $fulfillmentId)
    {
        return join(
            DIRECTORY_SEPARATOR,
            [
                ShopifyOrder::PLURAL,
                $orderId,
                ShopifyFulfillment::PLURAL,
                $fulfillmentId
            ]
        ) . DIRECTORY_SEPARATOR;
    }
}
