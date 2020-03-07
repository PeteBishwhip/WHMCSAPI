<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddContactTest extends BaseTest
{

    public function testCanUseAcceptOrderCommand()
    {
        $GLOBALS['whmcsApi']->command('AddContact');
        $this->assertEquals('AddContact', $GLOBALS['whmcsApi']->action);
    }

    public function testNoFirstNameCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->firstname);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->clientid = 1;
        $GLOBALS['whmcsApi']->firstname = 'Test';
        $GLOBALS['whmcsApi']->lastname = 'User';
        $GLOBALS['whmcsApi']->companyname = 'WHMCSAPI';
        $GLOBALS['whmcsApi']->email = 'test1@example.net';
        $GLOBALS['whmcsApi']->address1 = '123 Test Street';
        $GLOBALS['whmcsApi']->address2 = 'Appt. 123';
        $GLOBALS['whmcsApi']->city = 'London';
        $GLOBALS['whmcsApi']->state = 'London';
        $GLOBALS['whmcsApi']->postcode = 'N1 123';
        $GLOBALS['whmcsApi']->country = 'GB';
        $GLOBALS['whmcsApi']->phonenumber = '01234567890';
        $GLOBALS['whmcsApi']->tax_id = '1234567';
        $GLOBALS['whmcsApi']->password2 = 'MyT3s7P455w0rD';
        $this->assertEquals('test1@example.net', $GLOBALS['whmcsApi']->email);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
