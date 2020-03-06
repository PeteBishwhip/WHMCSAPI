<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddClientNoteTest extends BaseTest
{

    public function testCanUseAcceptOrderCommand()
    {
        $GLOBALS['whmcsApi']->command('AddClientNote');
        $this->assertEquals('AddClientNote', $GLOBALS['whmcsApi']->action);
    }

    public function testNoNotesCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->notes);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->userid = '1';
        $GLOBALS['whmcsApi']->notes = 'This is a test note';
        $GLOBALS['whmcsApi']->sticky = true;
        $this->assertEquals('This is a test note', $GLOBALS['whmcsApi']->notes);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
