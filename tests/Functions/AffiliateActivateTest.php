<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AffiliateActivateTest extends BaseTest
{
    public function testCanUseAffiliateActivateCommand()
    {
        $GLOBALS['whmcsApi']->command('AffiliateActivate');
        $this->assertEquals('AffiliateActivate', $GLOBALS['whmcsApi']->action);
    }

    public function testRequiredAttributesNotSetFails()
    {
        $this->assertNull($GLOBALS['whmcsApi']->userid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testIncorrectModuleTypeCauseException()
    {
        $GLOBALS['whmcsApi']->userid = 'NotNumeric';
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->userid = 1;
        $this->assertEquals('1', $GLOBALS['whmcsApi']->userid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('userid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
