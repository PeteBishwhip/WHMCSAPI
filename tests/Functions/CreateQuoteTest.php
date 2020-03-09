<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CreateQuoteTest extends BaseTest
{

    public function testCanUseAcceptOrderCommand()
    {
        $GLOBALS['whmcsApi']->command('CreateQuote');
        $this->assertEquals('CreateQuote', $GLOBALS['whmcsApi']->action);
    }

    public function testNoSubjectCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->subject);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->subject = 'Test Quote';
        $GLOBALS['whmcsApi']->stage = 'Delivered';
        $GLOBALS['whmcsApi']->firstname = 'Test';
        $GLOBALS['whmcsApi']->lastname = 'User';
        $GLOBALS['whmcsApi']->companyname = 'WHMCSAPI';
        $GLOBALS['whmcsApi']->email = 'test@example.net';
        $GLOBALS['whmcsApi']->address1 = '123 Test Street';
        $GLOBALS['whmcsApi']->address2 = 'Appt. 123';
        $GLOBALS['whmcsApi']->city = 'London';
        $GLOBALS['whmcsApi']->state = 'London';
        $GLOBALS['whmcsApi']->postcode = 'N1 123';
        $GLOBALS['whmcsApi']->country = 'GB';
        $GLOBALS['whmcsApi']->phonenumber = '01234567890';
        $GLOBALS['whmcsApi']->tax_id = '1234567';
        $GLOBALS['whmcsApi']->lineitems = base64_encode(serialize([
            [
                'desc'    => 'Test Description',
                'qty'     => 1,
                'up'      => 10.00,
                'taxable' => true,
            ]
        ]));
        $this->assertEquals('test@example.net', $GLOBALS['whmcsApi']->email);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('subject', $result);
        $this->assertArrayHasKey('stage', $result);
        $this->assertArrayHasKey('firstname', $result);
        $this->assertArrayHasKey('lastname', $result);
        $this->assertArrayHasKey('companyname', $result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('address1', $result);
        $this->assertArrayHasKey('address2', $result);
        $this->assertArrayHasKey('city', $result);
        $this->assertArrayHasKey('state', $result);
        $this->assertArrayHasKey('postcode', $result);
        $this->assertArrayHasKey('country', $result);
        $this->assertArrayHasKey('phonenumber', $result);
        $this->assertArrayHasKey('tax_id', $result);
        $this->assertArrayHasKey('lineitems', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
