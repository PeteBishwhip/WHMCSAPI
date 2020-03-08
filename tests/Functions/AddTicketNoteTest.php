<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddTicketNoteTest extends BaseTest
{

    public function testCanUseAddTicketNoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AddTicketNote');
        $this->assertEquals('AddTicketNote', $GLOBALS['whmcsApi']->action);
    }

    public function testNoNotesCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->message);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->ticketid = '1';
        $GLOBALS['whmcsApi']->message = 'This is a test note';
        $GLOBALS['whmcsApi']->markdown = false;
        $this->assertEquals('This is a test note', $GLOBALS['whmcsApi']->message);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
