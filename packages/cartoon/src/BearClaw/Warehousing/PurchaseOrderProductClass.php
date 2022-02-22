<?php

namespace BearClaw\Warehousing;

use GuzzleHttp\RetryMiddleware;

class PurchaseOrderProductClass {

    public $data = [];

    function __construct(array $data)  {
        $this->data = $data;
    }

    public function getUnitQuantityInitial() : float   {
        if(!$this->data['unit_quantity_initial']) return 0.0;
        return floatval($this->data['unit_quantity_initial']);
    }

    public function getProduct() : ProductClass {
        return new ProductClass($this->data['Product']);

    }

}