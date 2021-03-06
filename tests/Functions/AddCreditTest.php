<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddCreditTest extends BaseTest
{

    public function testCanUseAddCreditCommand()
    {
        $GLOBALS['whmcsApi']->command('AddCredit');
        $this->assertEquals('AddCredit', $GLOBALS['whmcsApi']->action);
    }

    public function testNoClientIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->clientid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddCredit';
        if (defined($class . '::DEFAULTS')) {
            foreach ($class::DEFAULTS as $attribute => $default) {
                $this->assertEquals($default, $GLOBALS['whmcsApi']->$attribute);
            }
        }
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->clientid = 1;
        $GLOBALS['whmcsApi']->description = 'Adding Credit!';
        $GLOBALS['whmcsApi']->amount = 1.23;
        $GLOBALS['whmcsApi']->date = date('Y-m-d');
        $GLOBALS['whmcsApi']->adminid = 1;
        $this->assertEquals(1.23, $GLOBALS['whmcsApi']->amount);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('clientid', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('amount', $result);
        $this->assertArrayHasKey('date', $result);
        $this->assertArrayHasKey('adminid', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
