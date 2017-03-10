<?php
namespace Shopify;

interface HttpResponseInterface
{
    public function httpStatus();

    public function parsedResponse();

    public function body();

    public function creditUsed();

    public function creditLimit();

    public function creditLeft();
}