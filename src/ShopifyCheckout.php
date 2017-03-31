<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyCheckout extends ShopifyObject
{
    use Countable;
    use CommonReadList;
    use CommonReadCount;

    const PLURAL = "checkouts";
    const SINGULAR = "checkout";
}
