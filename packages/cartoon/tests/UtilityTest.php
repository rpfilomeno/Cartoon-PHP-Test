<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class UtilityTest extends TestCase
{
    public function testCanTranslateStringOutput() : void {
        $input = 'Product Type 1 has total of 41.5\nProduct Type 2 has total of 13.8\nProduct Type 3 has total of 25.0\n';
        $output = \BearClaw\Warehousing\Utility::translateStringOutput($input);

        $this->assertIsArray($output);
        $this->assertIsFloat($output[0]['total']);
        $this->assertEquals($output[0]['total'],25.0);
    }

}