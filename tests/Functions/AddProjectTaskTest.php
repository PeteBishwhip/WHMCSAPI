<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddProjectTaskTest extends BaseTest
{

    public function testCanUseAddTicketNoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AddProjectTask');
        $this->assertEquals('AddProjectTask', $GLOBALS['whmcsApi']->action);
    }

    public function testNoProjectIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->projectid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddProjectTask';
        if (defined($class . '::DEFAULTS')) {
            foreach ($class::DEFAULTS as $attribute => $default) {
                $this->assertEquals($default, $GLOBALS['whmcsApi']->$attribute);
            }
        } else {
            $this->addToAssertionCount(1);
        }
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->projectid = 1;
        $GLOBALS['whmcsApi']->duedate = date('Y-m-d H:i:s');
        $GLOBALS['whmcsApi']->task = "WHMCSAPI Test Task";
        $this->assertEquals(false, $GLOBALS['whmcsApi']->completed);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('projectid', $result);
        $this->assertArrayHasKey('duedate', $result);
        $this->assertArrayHasKey('task', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
