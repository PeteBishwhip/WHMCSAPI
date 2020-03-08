<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CancelOrderTest extends BaseTest
{
    public function testCanUseCancelOrderCommand()
    {
        $GLOBALS['whmcsApi']->orderid = 1;
        $GLOBALS['whmcsApi']->command('CancelOrder');
        $this->assertEquals('CancelOrder', $GLOBALS['whmcsApi']->action);
    }

    public function testNoQuoteIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->orderid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->orderid = 1;
        $GLOBALS['whmcsApi']->cancelsub = true;
        $GLOBALS['whmcsApi']->noemail = false;
        $this->assertEquals('1', $GLOBALS['whmcsApi']->orderid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('orderid', $result);
        $this->assertArrayHasKey('cancelsub', $result);
        $this->assertArrayHasKey('noemail', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
