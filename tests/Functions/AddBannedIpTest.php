<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddBannedIpTest extends BaseTest
{
    public function testCanUseAddBannedIpCommand()
    {
        $GLOBALS['whmcsApi']->command('AddBannedIp');
        $this->assertEquals('AddBannedIp', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIPCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->ip);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->ip = '1.2.3.4';
        $GLOBALS['whmcsApi']->reason = 'PHPUnit Testing';
        $GLOBALS['whmcsApi']->days = 7;
        $GLOBALS['whmcsApi']->expires = date('Y-m-d H:i:s');
        $this->assertEquals(7, $GLOBALS['whmcsApi']->days);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('ip', $result);
        $this->assertArrayHasKey('reason', $result);
        $this->assertArrayHasKey('days', $result);
        $this->assertArrayHasKey('expires', $result);
        $this->assertEquals('1.2.3.4', $result['ip']);
        $this->assertEquals('PHPUnit Testing', $result['reason']);
        $this->assertEquals(7, $result['days']);
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('datetime', $result['expires']));
    }
}
