<?php


namespace App\Tests\Classes;

use App\Classes\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest  extends TestCase
{

    public function testCalcMainValuteDesc()
    {
        $calculator = new Calculator();
        $result = $calculator->calcMainValuteDesc(60.59, 12);

        $this->assertEquals(0.19805248390823568, $result);
    }

    public function testCalcMainValuteAsc(){
        $calculator = new Calculator();
        $result = $calculator->calcMainValuteAsc(60.59, 12);

        $this->assertEquals(727.08, $result);
    }
}
