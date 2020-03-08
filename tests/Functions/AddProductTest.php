<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddProductTest extends BaseTest
{
    public function testCanUseUpdateQuoteCommand()
    {
        $GLOBALS['whmcsApi']->quoteid = 1;
        $GLOBALS['whmcsApi']->command('AddProduct');
        $this->assertEquals('AddProduct', $GLOBALS['whmcsApi']->action);
    }

    public function testNoProductNameCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->name);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testDefaultValuesAreSet()
    {
        $class = '\\WHMCSAPI\\Functions\\AddProduct';
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
        $GLOBALS['whmcsApi']->gid = 1;
        $GLOBALS['whmcsApi']->name = 'Test Product';
        $this->assertEquals(1, $GLOBALS['whmcsApi']->gid);
        $this->assertEquals('Test Product', $GLOBALS['whmcsApi']->name);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('gid', $result);
        $this->assertArrayHasKey('name', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
