<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CreateProjectTest extends BaseTest
{

    public function testCanUseCreateProjectCommand()
    {
        $GLOBALS['whmcsApi']->command('CreateProject');
        $this->assertEquals('CreateProject', $GLOBALS['whmcsApi']->action);
    }

    public function testNoTitleCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->title);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->title = 'This is a title';
        $GLOBALS['whmcsApi']->adminid = 1;
        $GLOBALS['whmcsApi']->duedate = date('Y-m-d');
        $this->assertEquals('This is a title', $GLOBALS['whmcsApi']->title);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('adminid', $result);
        $this->assertArrayHasKey('duedate', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
