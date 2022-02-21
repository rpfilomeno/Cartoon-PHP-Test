<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function check() {
        //TODO Do the actual API return
        return response()->json(['message'=>'Success']);
    }
}
