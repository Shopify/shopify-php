<?php
namespace Shopify;

interface HttpResponseInterface
{
    public function getStatus();

    public function getJson();

    public function rawBody();

    public function bucketFill();

    public function bucketSize();

    public function bucketSpace();
}