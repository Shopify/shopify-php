<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait Countable
{
    protected function _getCount($parentId = null, $options = [])
    {
        if (method_exists(get_class(), '_prefix')) {
            return $this->_client->call("GET", $this->_prefix($parentId) . $this::PLURAL . DIRECTORY_SEPARATOR . "count", null, $options);
        }
        return $this->_client->call("GET", $this::PLURAL . DIRECTORY_SEPARATOR . "count" ,null, $options);
    }
}