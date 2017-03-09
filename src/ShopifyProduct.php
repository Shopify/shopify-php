<?php
namespace Shopify;

class ShopifyProduct extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonReadList;
    use CommonCreate;
    use CommonDestroy;
    use CommonUpdate;
    use CommonReadCount;

    const PLURAL = "products";
    const SINGULAR = "product";

}