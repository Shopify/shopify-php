<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonReadCount
{
    public function readCount(array $options = [])
    {
        return $this->getCount(null, $options);
    }
}
