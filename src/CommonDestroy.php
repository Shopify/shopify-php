<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait CommonDestroy
{
    public function destroy($id)
    {
        return $this->delete($id);
    }
    
    public function destroyAllMeta($id)
    {
        return $this->deleteAllMeta($id);
    }
}
