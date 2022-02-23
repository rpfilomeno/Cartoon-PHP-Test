<?php

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Authentication check
 *
 * Check that the service is up. If everything is okay, you'll get a 200 OK response.
 *
 * @header Accept application/json
 * @response 200 scenario="Authentication is correct"
 * @response 401 scenario="Invalid credentials"
 */
Route::get('check', [TestController::class,'check'])->middleware('auth.basic.once');

/**
 * Run test code
 *
 * Run the test code based on assessment requirement. If everything is okay, you'll get a json with 200 OK response.
 *
 * @header Accept application/json
 * @bodyParam testinput object[] Input details. Example: {"purchase_order_ids":[2344, 2345, 2346]}
 * @bodyParam testinput.purchase_order_ids int[] List of purchase order id's
 * @response 200 scenario="Sucessful test code execution" {"result":[{"product_type_id":1,"total":41.5},{"product_type_id":2,"total":13.8},{"product_type_id":3,"total":25}]}
 * @response 401 scenario="Invalid credentials"
 */
Route::post('test', [TestController::class,'test'])->middleware('auth.basic.once');
