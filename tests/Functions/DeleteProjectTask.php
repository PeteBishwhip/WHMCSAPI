<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeleteProjectTask extends BaseTest
{

    public function testCanUseDeleteProjectCommand()
    {
        $GLOBALS['whmcsApi']->command('DeleteProject');
        $this->assertEquals('DeleteProject', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->projectid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->projectid = 1;
        $GLOBALS['whmcsApi']->taskid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->projectid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('projectid', $result);
        $this->assertArrayHasKey('taskid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
