<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyCustomCollection extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonReadList;
    use CommonCreate;
    use CommonDestroy;
    use CommonUpdate;
    use CommonReadCount;

    const PLURAL = "custom_collections";
    const SINGULAR = "custom_collection";
}
