<?php

namespace App\Http\Controllers;


use BearClaw\Warehousing\TotalsCalculator;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function check() {
        return response()->json(['message'=>'Success']);
    }


    public function test(Request $request) {
        
        $body = json_decode($request->getContent(),true);
        
        if(!$body['purchase_order_ids'] || !is_array($body['purchase_order_ids'])) {
            return response()->json(['message'=>'No purchase_order_ids found'],400);
        }
        
        //we want to trap the echo() from TotalsCalculator because were not allowed to modify that in rules of exam.
        $results = '';
        ob_start(); 
        $newtotals = new TotalsCalculator();
        $newtotals->generateReport(array_values($body['purchase_order_ids']));
        $results = ob_get_contents();
        ob_end_clean();


        //quick transformation
        $transform = \BearClaw\Warehousing\Utility::translateStringOutput($results);

        return response()->json(['result'=>$transform]);
    }
}
