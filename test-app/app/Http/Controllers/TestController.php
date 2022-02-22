<?php

namespace App\Http\Controllers;


use BearClaw\Warehousing\TotalsCalculator;

class TestController extends Controller
{
    
    public function check() {
        return response()->json(['message'=>'Success']);
    }


    public function test() {
        $results = '';

        ob_start(); //we want to trap the echo() from TotalsCalculator because were not allowed to modify that in rules of exam.
        $newtotals = new TotalsCalculator();
        $newtotals->generateReport([2344,2345,2346]);
        $results = ob_get_contents();
        ob_end_clean();


        //quick transformation
        //TODO: move this to a static class method if theres time left
        $transform = \BearClaw\Warehousing\Utility::translateStringOutput($results);

        return response()->json(['result'=>$transform]);
    }
}
