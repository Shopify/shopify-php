<?php
namespace Shopify;

class ShopifyCheckout extends ShopifyObject
{
    use Countable;
    use CommonReadList;
    use CommonReadCount;

    const PLURAL = "checkouts";
    const SINGULAR = "checkout";

}