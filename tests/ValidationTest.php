<?php

namespace WHMCSAPI\Tests;

class ValidationTest extends BaseTest
{
    function testEmailValidationFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('email', 'thisIsa String'));
    }

    function testEmailValidationSucceeds()
    {
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('email', 'realmail@example.net'));
    }

    function testIpAddressValidationFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('ipaddress', '256.123.254.3'));
    }

    function testIpAddressValidationSucceeds()
    {
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('ipaddress', '254.123.254.3'));
    }

    function testDateTimeValidationFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('datetime', '07/03/2020 01:12'));
    }

    function testDateTimeValidationSucceeds()
    {
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('datetime', '2020-03-07 01:12:00'));
    }

    function testArrayValidationFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('array', 12345));
    }

    function testArrayValidationSucceeds()
    {
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('array', ['12345']));
    }

    function testFloatValidationFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('float', 'd4t3t1m3'));
    }

    function testFloatValidationSucceeds()
    {
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('float', 1.23));
        $this->assertFalse($GLOBALS['whmcsApi']->inputValidate('float', '1.23'));
    }

    function testNonSupportedValidationTypeAutomaticallyFails()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('validateThis', 'fsdhkjdh'));
    }
}
