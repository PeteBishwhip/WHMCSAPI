<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class ActivateModuleTest extends BaseTest
{
    public function testCanUseActivateModuleCommand()
    {
        $GLOBALS['whmcsApi']->command('ActivateModule');
        $this->assertEquals('ActivateModule', $GLOBALS['whmcsApi']->action);
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
        $this->assertStringContainsString('{"result":', $result);
    }
}
