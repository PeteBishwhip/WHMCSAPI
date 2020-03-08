<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AcceptOrderTest extends BaseTest
{

    public function testCanUseAcceptOrderCommand()
    {
        $GLOBALS['whmcsApi']->command('AcceptOrder');
        $this->assertEquals('AcceptOrder', $GLOBALS['whmcsApi']->action);
    }

    public function testNoOrderIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->orderid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->orderid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->orderid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('orderid', $result);
        $this->assertEquals(1, $result['orderid']);
    }
}
