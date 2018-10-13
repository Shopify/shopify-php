<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonRead
{
    public function read($id)
    {
        return $this->get($id);
    }
    
    public function readMeta($id)
    {
        return $this->getMeta($id);
    }
}
