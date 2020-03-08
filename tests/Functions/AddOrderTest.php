<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddOrderTest extends BaseTest
{

    public function testCanUseAddOrderCommand()
    {
        $GLOBALS['whmcsApi']->command('AddOrder');
        $this->assertEquals('AddOrder', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->clientid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddOrder';
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
        $GLOBALS['whmcsApi']->clientid = 1;
        $GLOBALS['whmcsApi']->paymentmethod = 'mailin';
        $GLOBALS['whmcsApi']->pid = ['1'];
        $GLOBALS['whmcsApi']->domain = ['whmcsapitest' . time() . '.com'];
        $GLOBALS['whmcsApi']->nameserver1 = ['ns1.whmcsapitest.com'];
        $GLOBALS['whmcsApi']->nameserver2 = ['ns2.whmcsapitest.com'];
        $GLOBALS['whmcsApi']->noemail = true;
        $GLOBALS['whmcsApi']->noinvoiceemail = true;
        $this->assertEquals('mailin', $GLOBALS['whmcsApi']->paymentmethod);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('clientid', $result);
        $this->assertArrayHasKey('paymentmethod', $result);
        $this->assertArrayHasKey('pid', $result);
        $this->assertArrayHasKey('domain', $result);
        $this->assertArrayHasKey('nameserver1', $result);
        $this->assertArrayHasKey('nameserver2', $result);
        $this->assertArrayHasKey('noemail', $result);
        $this->assertArrayHasKey('noinvoiceemail', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
