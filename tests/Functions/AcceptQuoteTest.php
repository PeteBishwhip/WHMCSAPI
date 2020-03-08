<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AcceptQuoteTest extends BaseTest
{
    public function testCanUseAcceptQuoteCommand()
    {
        $GLOBALS['whmcsApi']->command('AcceptQuote');
        $this->assertEquals('AcceptQuote', $GLOBALS['whmcsApi']->action);
    }

    public function testNoQuoteIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->quoteid);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->quoteid = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->quoteid);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('quoteid', $result);
        $this->assertEquals(1, $result['quoteid']);
    }
}
