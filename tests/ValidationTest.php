<?php

namespace WHMCSAPI\Tests;

use WHMCSAPI\Exception\NotServiceable;

class ValidationTest extends BaseTest
{
    function testEmailValidationFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('email', 'thisIsa String');
    }

    function testEmailValidationSucceeds()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('email', 'realmail@example.net'));
    }

    function testIpAddressValidationFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('ipaddress', '256.123.254.3');
    }

    function testIpAddressValidationSucceeds()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('ipaddress', '254.123.254.3'));
    }

    function testDateTimeValidationFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('datetime', '07/03/2020 01:12');
    }

    function testDateTimeValidationSucceeds()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('datetime', '2020-03-07 01:12:00'));
    }

    function testArrayValidationFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('array', 12345);
    }

    function testArrayValidationSucceeds()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('array', ['12345']));
    }

    function testFloatValidationFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('float', 'd4t3t1m3');
    }

    function testFloatValidationSucceeds()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('float', 1.23));
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('float', '1.23'));
    }

    function testNonSupportedValidationTypeAutomaticallyFails()
    {
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->inputValidate('validateThis', 'fsdhkjdh');
    }
}
