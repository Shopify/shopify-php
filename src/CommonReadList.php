<?php
namespace Shopify;

trait CommonReadList
{
    public function readList(Array $options = [])
    {
        return $this->_getList($options);
    }
}