<?php
namespace Shopify;

interface HttpResponseInterface
{
    public function httpStatus();

    public function json();

    public function body();

    public function creditUsed();

    public function creditLimit();

    public function creditLeft();
}