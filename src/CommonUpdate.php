<?php
namespace Shopify;

trait CommonUpdate
{
    public function update($id, $data)
    {
        return $this->_put($id, $data);
    }
}