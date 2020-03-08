<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddProjectMessageTest extends BaseTest
{

    public function testCanUseAddTicketNoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AddProjectMessage');
        $this->assertEquals('AddProjectMessage', $GLOBALS['whmcsApi']->action);
    }

    public function testNoProjectIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->projectid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->projectid = '1';
        $GLOBALS['whmcsApi']->message = 'This is a test message';
        $this->assertEquals('This is a test message', $GLOBALS['whmcsApi']->message);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
