<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeleteTicketTest extends BaseTest
{

    public function testCanUseDeleteTicketCommand()
    {
        $GLOBALS['whmcsApi']->command('DeleteTicket');
        $this->assertEquals('DeleteTicket', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->ticketid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->ticketid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->ticketid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('ticketid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
