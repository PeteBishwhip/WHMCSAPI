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
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('projectid', $result);
        $this->assertArrayHasKey('message', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
