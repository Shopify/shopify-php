<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyVariant extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonUpdate;
    use CommonDestroy;

    const PLURAL = "variants";
    const SINGULAR = "variant";

    public function readList($productId = null, array $options = [])
    {
        return $this->getList($options, $this->prefix($productId));
    }

    public function create($productId, array $data)
    {
        return $this->post($data, $this->prefix($productId));
    }

    public function readCount($productId = null, array $options = [])
    {
        return $this->getCount($productId, $options);
    }

    protected function prefix($parentId)
    {
        if ($parentId) {
            return ShopifyProduct::PLURAL . DIRECTORY_SEPARATOR . $parentId . DIRECTORY_SEPARATOR;
        }
        return '';
    }
}
