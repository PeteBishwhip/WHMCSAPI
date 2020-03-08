<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddTransactionTest extends BaseTest
{

    public function testCanUseAddTicketNoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AddTransaction');
        $this->assertEquals('AddTransaction', $GLOBALS['whmcsApi']->action);
    }

    public function testNoPaymentMethodCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->paymentmethod);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddTransaction';
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
        $GLOBALS['whmcsApi']->paymentmethod = 'mailin';
        $GLOBALS['whmcsApi']->userid = 1;
        $GLOBALS['whmcsApi']->transid = time();
        $GLOBALS['whmcsApi']->credit = true;
        $this->assertEquals('mailin', $GLOBALS['whmcsApi']->paymentmethod);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
