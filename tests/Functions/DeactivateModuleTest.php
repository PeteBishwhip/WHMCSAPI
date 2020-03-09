<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeactivateModuleTest extends BaseTest
{
    public function testCanUseDeactivateModuleCommand()
    {
        $GLOBALS['whmcsApi']->command('DeactivateModule');
        $this->assertEquals('DeactivateModule', $GLOBALS['whmcsApi']->action);
    }

    public function testRequiredAttributesNotSetFails()
    {
        $this->assertNull($GLOBALS['whmcsApi']->moduleType);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testIncorrectModuleTypeCauseException()
    {
        $GLOBALS['whmcsApi']->moduleType = 'thisWontWork';
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->moduleType = 'gateway';
        $GLOBALS['whmcsApi']->moduleName = 'mailin';
        $this->assertEquals('gateway', $GLOBALS['whmcsApi']->moduleType);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('moduleType', $result);
        $this->assertArrayHasKey('moduleName', $result);
        $this->assertEquals('gateway', $result['moduleType']);
        $this->assertEquals('mailin', $result['moduleName']);
    }
}
