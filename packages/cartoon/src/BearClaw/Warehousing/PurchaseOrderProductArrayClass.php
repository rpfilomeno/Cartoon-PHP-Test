<?php

namespace BearClaw\Warehousing;

class PurchaseOrderProductArrayClass implements  \ArrayAccess {

    private $container = [];

    public function offsetSet($offset, $value) : void {
        if (!$value instanceof PurchaseOrderProductClass) {
            throw new \Exception('value must be an instance of PurchaseOrderProductClass');
        }

        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) : bool {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) : void  {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}