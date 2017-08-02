<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

class ShopifyObject
{
    protected $client;

    public function __construct(ShopifyClient $client)
    {
        $this->client = $client;
    }

    protected function get($id, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->client->call("GET", $resource, null, null);
    }
    
    protected function getMeta($id, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR .'metafields';
        return $this->client->call("GET", $resource, null, null);
    }

    protected function getList(array $options = [], $prefix = '')
    {
        $resource = $prefix . static::PLURAL;
        return $this->client->call("GET", $resource, null, $options);
    }

    protected function post($data, $prefix = '')
    {
        $resource = $prefix . static::PLURAL;
        return $this->client->call("POST", $resource, [static::SINGULAR => $data], []);
    }

    protected function delete($id, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->client->call("DELETE", $resource, null, null);
    }
    
    protected function deleteAllMeta($id, $prefix = '')
    {
    	// get the meta for this item
	    $meta = $this->getMeta($id, $prefix)->parsedResponse();
	    foreach ($meta as $meta_item) {
	    	$resource = $prefix . static::PLURAL
		        . DIRECTORY_SEPARATOR . $id
		        . DIRECTORY_SEPARATOR .'metafields'
		        . DIRECTORY_SEPARATOR . $meta_item->id;
            $this->client->call("DELETE", $resource, null, null);
	    }
    }
    
    protected function put($id, $data, $prefix = '')
    {
        $resource = $prefix . static::PLURAL . DIRECTORY_SEPARATOR . $id;
        return $this->client->call("PUT", $resource, [static::SINGULAR => $data], null);
    }
	
}
