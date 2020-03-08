<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddCancelRequestTest extends BaseTest
{
    public function testCanUseAddBillableItemCommand()
    {
        $GLOBALS['whmcsApi']->command('AddCancelRequest');
        $this->assertEquals('AddCancelRequest', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->serviceid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->serviceid = '1';
        $GLOBALS['whmcsApi']->type = 'Immediate';
        $GLOBALS['whmcsApi']->reason = "Testing";
        $this->assertEquals('Immediate', $GLOBALS['whmcsApi']->type);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('serviceid', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('reason', $result);
        $this->assertEquals(1, $result['serviceid']);
        $this->assertEquals('Immediate', $result['type']);
        $this->assertEquals('Testing', $result['reason']);
    }
}
