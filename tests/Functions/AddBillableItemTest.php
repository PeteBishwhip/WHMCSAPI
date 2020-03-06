<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddBillableItemTest extends BaseTest
{
    public function testCanUseAddBillableItemCommand()
    {
        $GLOBALS['whmcsApi']->command('AddBillableItem');
        $this->assertEquals('AddBillableItem', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->clientid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->clientid = '1';
        $GLOBALS['whmcsApi']->description = 'PHPUnit Testing';
        $GLOBALS['whmcsApi']->amount = 7.50;
        $GLOBALS['whmcsApi']->invoiceaction = 'noinvoice';
        $GLOBALS['whmcsApi']->recur = 6;
        $GLOBALS['whmcsApi']->recurcycle = 'Days';
        $GLOBALS['whmcsApi']->recurfor = 2;
        $GLOBALS['whmcsApi']->duedate = date('Y-m-d H:i:s');
        $GLOBALS['whmcsApi']->hours = 2;
        $this->assertEquals('PHPUnit Testing', $GLOBALS['whmcsApi']->description);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
