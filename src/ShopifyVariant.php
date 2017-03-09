<?php
namespace Shopify;

class ShopifyVariant extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonUpdate;
    use CommonDestroy;

    const PLURAL = "variants";
    const SINGULAR = "variant";

    public function readList($productId = null, Array $options = [])
    {
        return $this->_getList($options, $this->_prefix($productId));
    }

    public function create($productId, Array $data)
    {
        return $this->_post($data, $this->_prefix($productId));
    }

    public function readCount($productId = null, Array $options = [])
    {
        return $this->_getCount($productId, $options);
    }

    protected function _prefix($parentId)
    {
        if ($parentId) {
            return ShopifyProduct::PLURAL . DIRECTORY_SEPARATOR . $parentId . DIRECTORY_SEPARATOR;
        }
        return '';
    }
}