<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeleteQuoteTest extends BaseTest
{

    public function testCanUseDeleteQuoteCommand()
    {
        $GLOBALS['whmcsApi']->command('DeleteQuote');
        $this->assertEquals('DeleteQuote', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
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
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
