<?php
namespace Shopify;

trait CommonCreate
{
    public function create($data)
    {
        return $this->_post($data);
    }
}