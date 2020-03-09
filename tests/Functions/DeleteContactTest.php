<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeleteContactTest extends BaseTest
{

    public function testCanUseDeleteContactCommand()
    {
        $GLOBALS['whmcsApi']->command('DeleteContact');
        $this->assertEquals('DeleteContact', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->contactid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->contactid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->contactid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('contactid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
