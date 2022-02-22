<?php
namespace BearClaw\Warehousing;

class Utility {
    static function translateStringOutput($string) : array {
        $results = explode("\n",$string);
        $transform = null;
        foreach($results as $result) {
            if (preg_match('/Product Type (.*) has total of (.*)/', $result, $regs)) {
                $transform[] = array("product_type_id"=> (int) $regs[1], "total"=> (float) $regs[2]);
            } 
        }
        return $transform;
    }
}