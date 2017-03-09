<?php
namespace Shopify;

trait CommonRead
{
    public function read($id)
    {
        return $this->_get($id);
    }
}