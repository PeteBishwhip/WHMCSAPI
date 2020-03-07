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
        $GLOBALS['whmcsApi']->adminid = 1;
        $this->assertEquals(1.23, $GLOBALS['whmcsApi']->amount);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
