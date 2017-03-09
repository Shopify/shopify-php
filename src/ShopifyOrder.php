<?php
namespace Shopify;

class ShopifyOrder extends ShopifyObject
{
    use Countable;
    use CommonRead;
    use CommonDestroy;
    use CommonReadList;
    use CommonUpdate;
    use CommonCreate;
    use CommonReadCount;

    const PLURAL = "orders";
    const SINGULAR = "order";

    public function close($id)
    {
        $resource = join(DIRECTORY_SEPARATOR, [self::PLURAL, $id, "close"]);
        return $this->_client->call("POST", $resource, []);
    }

    public function open($id)
    {
        $resource = join(DIRECTORY_SEPARATOR, [self::PLURAL, $id, "open"]);
        return $this->_client->call("POST", $resource, []);
    }

    public function cancel($id, Array $data = [])
    {
        $resource = join(DIRECTORY_SEPARATOR, [self::PLURAL, $id, "cancel"]);
        return $this->_client->call("POST", $resource, $data);
    }
}