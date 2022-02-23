<?php
namespace BearClaw\Warehousing;

class Utility {
    static function translateStringOutput( string $string ) : array {
        $results = explode("\n",$string);
        $transform = null;
        foreach($results as $result) {
            if (preg_match('/Product Type (.*) has total of (.*)/', $result, $regs)) {
                $transform[] = array("product_type_id"=> (int) $regs[1], "total"=> (float) $regs[2]);
            } 
        }
        return $transform;
    }

    static function calculateTotal( PurchaseOrderProductClass $purchaseOrderProducts, ProductClass $product) : float {
        $total = 0;
        switch($product->getProductType()) {
            case 1:
                $total += $purchaseOrderProducts->getUnitQuantityInitial() * $product->getWeight();
                break;
            case 2:
                $total += $purchaseOrderProducts->getUnitQuantityInitial() * $product->getVolume();
                break;
            case 3:
                $total += $purchaseOrderProducts->getUnitQuantityInitial() * $product->getWeight();
                break;
        }

        return $total;
    }
}