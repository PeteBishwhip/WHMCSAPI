<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddInvoicePaymentTest extends BaseTest
{

    public function testCanUseAddCreditCommand()
    {
        $GLOBALS['whmcsApi']->command('AddInvoicePayment');
        $this->assertEquals('AddInvoicePayment', $GLOBALS['whmcsApi']->action);
    }

    public function testNoinvoiceIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->invoiceid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddInvoicePayment';
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
        $GLOBALS['whmcsApi']->invoiceid = 1;
        $GLOBALS['whmcsApi']->transid = 'TEST-' . time();
        $GLOBALS['whmcsApi']->gateway = 'mailin';
        $GLOBALS['whmcsApi']->amount = 1.23;
        $GLOBALS['whmcsApi']->date = date('Y-m-d');
        $this->assertEquals(1.23, $GLOBALS['whmcsApi']->amount);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('invoiceid', $result);
        $this->assertArrayHasKey('transid', $result);
        $this->assertArrayHasKey('gateway', $result);
        $this->assertArrayHasKey('amount', $result);
        $this->assertArrayHasKey('date', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
