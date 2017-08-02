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
        return $this->put($id, $data);
    }
    
    public function updateMeta($id, $data)
    {
        return $this->putMeta($id, $data);
    }
}
