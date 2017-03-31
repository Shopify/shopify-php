<?php
/**
 * @copyright Copyright (c) 2017 Shopify Inc.
 * @license MIT
 */

namespace Shopify;

trait Countable
{
    protected function getCount($parentId = null, $options = [])
    {
        if (method_exists(get_class(), 'prefix')) {
            return $this->client->call(
                "GET",
                $this->prefix($parentId) . $this::PLURAL . DIRECTORY_SEPARATOR . "count",
                null,
                $options
            );
        }
        return $this->client->call(
            "GET",
            $this::PLURAL . DIRECTORY_SEPARATOR . "count",
            null,
            $options
        );
    }
}
