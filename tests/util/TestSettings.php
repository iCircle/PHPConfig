<?php
/**
 * User: Raaghu
 * Date: 25-09-2015
 * Time: AM 11:57
 */

namespace icircle\tests\util;

use icircle\util\Settings;

class TestSettings extends \PHPUnit_Framework_TestCase{

    public function testGetSettings(){
        $isException = false;
        try{
            Settings::getSettings('icircle/dummyPackage');
        }catch (\Exception $e){
            $isException = true;
            $this->assertEquals("No configuration found for the package icircle/dummyPackage",$e->getMessage());
        }
        $this->assertTrue($isException);
    }
}