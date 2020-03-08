<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class ApplyCreditTest extends BaseTest
{

    public function testCanUseAddCreditCommand()
    {
        $GLOBALS['whmcsApi']->command('ApplyCredit');
        $this->assertEquals('ApplyCredit', $GLOBALS['whmcsApi']->action);
    }

    public function testNoInvoiceIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->invoiceid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\ApplyCredit';
        if (defined($class . '::DEFAULTS')) {
            foreach ($class::DEFAULTS as $attribute => $default) {
                $this->assertEquals($default, $GLOBALS['whmcsApi']->$attribute);
            }
        }
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->invoiceid = 1;
        $GLOBALS['whmcsApi']->amount = 1.23;
        $GLOBALS['whmcsApi']->noemail = true;
        $this->assertEquals(1.23, $GLOBALS['whmcsApi']->amount);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
