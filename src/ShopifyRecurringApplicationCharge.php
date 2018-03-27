<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyRecurringApplicationCharge extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonReadList;
    use CommonCreate;
    use CommonDestroy;
    use CommonUpdate;
    use CommonReadCount;

    const PLURAL = "recurring_application_charges";
    const SINGULAR = "recurring_application_charge";
}
