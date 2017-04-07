<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonReadCount
{
    public function readCount(Array $options = [])
    {
        return $this->_getCount(null, $options);
    }
}