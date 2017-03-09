<?php
namespace Shopify;

trait CommonReadCount
{
    public function readCount(Array $options = [])
    {
        return $this->_getCount(null, $options);
    }
}