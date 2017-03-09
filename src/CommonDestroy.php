<?php
namespace Shopify;

trait CommonDestroy
{
    public function destroy($id)
    {
        return $this->_delete($id);
    }
}