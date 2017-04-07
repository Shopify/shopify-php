<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonUpdate
{
    public function update($id, $data)
    {
        return $this->_put($id, $data);
    }
}