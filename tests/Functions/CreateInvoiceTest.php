<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CreateInvoiceTest extends BaseTest
{

    public function testCanUseCloseClientCommand()
    {
        $GLOBALS['whmcsApi']->command('CreateInvoice');
        $this->assertEquals('CreateInvoice', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->userid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->userid = 1;
        $GLOBALS['whmcsApi']->itemdescription1 = 'Testing';
        $GLOBALS['whmcsApi']->itemamount1 = 4.75;
        $GLOBALS['whmcsApi']->itemtaxed1 = true;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->userid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('userid', $result);
        $this->assertArrayHasKey('itemdescription1', $result);
        $this->assertArrayHasKey('itemamount1', $result);
        $this->assertArrayHasKey('itemtaxed1', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
