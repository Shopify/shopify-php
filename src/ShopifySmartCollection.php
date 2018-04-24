<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifySmartCollection extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonReadList;
    use CommonCreate;
    use CommonDestroy;
    use CommonUpdate;
    use CommonReadCount;

    const PLURAL = "smart_collections";
    const SINGULAR = "smart_collection";
}
