<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CloseClientTest extends BaseTest
{

    public function testCanUseCloseClientCommand()
    {
        $GLOBALS['whmcsApi']->command('CloseClient');
        $this->assertEquals('CloseClient', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->clientid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->clientid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->clientid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
