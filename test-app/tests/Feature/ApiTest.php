<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{

   
    public function test_CanCallCheckApi() : void {
        $headers = [
            'HTTP_Authorization' => 'Basic '. base64_encode('demo:pwd1234')
        ];
        
        $this->get('/api/check',$headers)
            ->assertStatus(200)
            ->dump();
    }

    public function test_CanCallTestApi() : void {
        $headers = [
            'HTTP_Authorization' => 'Basic '. base64_encode('demo:pwd1234'),
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        ];

        $payload = json_decode('{ "purchase_order_ids": ["2344", "2345", "2346"] }',true);
        $expected = json_decode('{"result":[{"product_type_id":1,"total":41.5},{"product_type_id":2,"total":13.8},{"product_type_id":3,"total":25}]}',true);

        $this->json('POST','/api/test', $payload, $headers)
            ->assertJson($expected)
            ->assertStatus(200)
            ->dump();

    }


}
