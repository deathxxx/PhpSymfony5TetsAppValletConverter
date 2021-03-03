<?php

namespace App\Tests\Classes;

use App\Classes\GetXml;
use PHPUnit\Framework\TestCase;

class GetXmlTest extends TestCase
{

    public function testGetXml() {
        $getXml = new GetXml('http://www.cbr.ru/scripts/XML_daily.asp');
        $ret = $getXml->getXml();
        $this->assertStringContainsString("xml",$ret," msg1");
    }

    public function testGetXmlHeader() {
        $getXml = new GetXml('http://www.cbr.ru/scripts/XML_daily.asp');
        $ret = $getXml->getXml();
        $this->assertEquals("Foreign Currency Market",$getXml->getHeaderAtribute($ret, "name")," msg2");
    }

}
