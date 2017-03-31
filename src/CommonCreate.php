<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonCreate
{
    public function create($data)
    {
        return $this->post($data);
    }
}
