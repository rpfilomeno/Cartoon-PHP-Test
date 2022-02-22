<?php

namespace BearClaw\Warehousing;


class ProductClass {

    private $data = [];

    function __construct(array $data)  {
        $this->data = $data;
    }

    public function getVolume() : float {
        return floatval($this->data['volume']);
    }

    public function getWeight() : float {
        return floatval($this->data['weight']);
    }

    public function getProductType() : int {
        return intval($this->data['product_type_id']);
    }
}