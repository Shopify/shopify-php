<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonReadList
{
    public function readList(array $options = [])
    {
        return $this->getList($options);
    }
}
