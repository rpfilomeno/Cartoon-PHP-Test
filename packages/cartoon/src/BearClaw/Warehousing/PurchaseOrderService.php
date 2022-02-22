<?php
namespace BearClaw\Warehousing;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;


class PurchaseOrderService {

    

    public function calculateTotals(array $ids) {

        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $results = array();

        
        

        
        $client = new Client();
        
        $requests = function ($ids) {
            //TODO: if theres time left set this in .env file
            $headers = [
                'Authorization' => 'Basic '. base64_encode('interview-test@cartoncloud.com.au:test123456'),
                'Accept' => 'application/json'
            ];

            foreach($ids as $key=> $value) {
                $uri = 'https://api.cartoncloud.com.au/CartonCloud_Demo/PurchaseOrders/' .  $value  . '?version=5&associated=true'; //TODO: if we have time set this in .env file
                yield new Request('GET', $uri, $headers);
            }
        };

        $pool = new Pool($client, $requests($ids), [
            'concurrency' => 5, //TODO: if we have time set this in .env file
            'fulfilled' => function (Response $response, $index) use (&$results){

                $results[] = json_decode((string)$response->getBody()->getContents(),true);
                

            },
            'rejected' => function (RequestException $reason, $index) {
                // TODO: if we have time handle request that failed.
            },
        ]);



        // Initiate the transfers and create a promise
        $promise = $pool->promise();

        // Force the pool of requests to complete.
        $promise->wait();


        

        

        //translate all responses
        $purchaseOrderProducts = new PurchaseOrderProductArrayClass();
        foreach ($results as $result) {
            foreach($result['data']['PurchaseOrderProduct'] as $item ) {
                
                $purchaseOrderProducts[] = new PurchaseOrderProductClass($item);
            }
        }


        //translate to required format
        //TODO: when theres time left, probably create a new class for each product_type_id from a common interface that define method to calculate
        $i = 0;

        

        while($purchaseOrderProducts[$i]) { //TODO: we should implement Iterator, Countable if we have time, for now we know the keys and increasing.
            $order = $purchaseOrderProducts[$i];
            $product = $order->getProduct();
            switch($product->getProductType()) {
                case 1:
                    $total1 += $order->getUnitQuantityInitial() * $product->getWeight();
                    break;
                case 2:
                    $total2 += $order->getUnitQuantityInitial() * $product->getVolume();
                    break;
                case 3:
                    $total3 += $order->getUnitQuantityInitial() * $product->getWeight();
                    break;
            }                    
            $i++;
        }

        
        $records = null;
        //we have to conform to expected returns of TotalsCalculator
        $records[] = array("product_type_id" => 1, "total" => sprintf("%.1f",$total1) );
        $records[] = array("product_type_id" => 2, "total" => sprintf("%.1f",$total2) );
        $records[] = array("product_type_id" => 3, "total" => sprintf("%.1f",$total3) );

       
        return $records;
    }
}
