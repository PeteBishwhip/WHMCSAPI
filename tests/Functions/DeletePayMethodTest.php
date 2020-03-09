<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeletePayMethodTest extends BaseTest
{

    public function testCanUseDeletePayMethodCommand()
    {
        $GLOBALS['whmcsApi']->command('DeletePayMethod');
        $this->assertEquals('DeletePayMethod', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->clientid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->clientid = 1;
        $GLOBALS['whmcsApi']->paymethodid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->clientid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('clientid', $result);
        $this->assertArrayHasKey('paymethodid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
