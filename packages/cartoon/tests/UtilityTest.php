<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UtilityTest extends TestCase
{
    private $order;
    private $sample;

    const EXPECTED_CAN_TRANSLATE_TOTAL = 25.0;
    const EXPECTED_CAN_CALCULATE_TOTAL = 12.0;
    
    
    protected function setUp(): void
    {
        $sampleTransaction = json_decode(file_get_contents(dirname(__FILE__)."/sample.json"),true);
        $this->order = new \BearClaw\Warehousing\PurchaseOrderProductClass($sampleTransaction['data']['PurchaseOrderProduct'][0]);
        $this->sample = file_get_contents(dirname(__FILE__)."/sample.txt");
        

    }

    public function testCanTranslateStringOutput() : void {
        $output = \BearClaw\Warehousing\Utility::translateStringOutput($this->sample);
        
        $this->assertIsArray($output);
        $this->assertIsFloat($output[0]['total']);
        $this->assertEquals($output[0]['total'], $this::EXPECTED_CAN_TRANSLATE_TOTAL);
    }

    public function testCanCalculateTotal() : void {
        $product = $this->order->getProduct();
        $testTtotal = \BearClaw\Warehousing\Utility::calculateTotal( $this->order, $product ); 

        $this->assertEquals($testTtotal, $this::EXPECTED_CAN_CALCULATE_TOTAL);
    }

}