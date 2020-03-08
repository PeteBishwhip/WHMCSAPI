<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CapturePaymentTest extends BaseTest
{

    public function testCanUseCapturePaymentCommand()
    {
        $GLOBALS['whmcsApi']->command('CapturePayment');
        $this->assertEquals('CapturePayment', $GLOBALS['whmcsApi']->action);
    }

    public function testNoOrderIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->invoiceid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->invoiceid = 1;
        $GLOBALS['whmcsApi']->cvv = '024';
        $this->assertEquals(1, $GLOBALS['whmcsApi']->invoiceid);
    }

    public function cvvPassesNumericalValidationStartingZero()
    {
        $this->assertTrue($GLOBALS['whmcsApi']->inputValidate('numeric', $GLOBALS['whmcsApi']->cvv));
        $this->assertEquals('024', $GLOBALS['whmcsApi']->cvv);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('invoiceid', $result);
        $this->assertArrayHasKey('cvv', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
