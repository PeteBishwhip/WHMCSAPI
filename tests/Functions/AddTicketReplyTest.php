<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddTicketReplyTest extends BaseTest
{

    public function testCanUseAddTicketNoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AddTicketReply');
        $this->assertEquals('AddTicketReply', $GLOBALS['whmcsApi']->action);
    }

    public function testNoTicketIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->ticketid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->ticketid = '1';
        $GLOBALS['whmcsApi']->message = 'This is a test reply!';
        $GLOBALS['whmcsApi']->markdown = false;
        $GLOBALS['whmcsApi']->noemail = true;
        $this->assertEquals('This is a test reply!', $GLOBALS['whmcsApi']->message);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('ticketid', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('markdown', $result);
        $this->assertArrayHasKey('noemail', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
