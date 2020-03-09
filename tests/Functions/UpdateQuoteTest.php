<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class UpdateQuoteTest extends BaseTest
{
    public function testCanUseUpdateQuoteCommand()
    {
        $GLOBALS['whmcsApi']->command('UpdateQuote');
        $this->assertEquals('UpdateQuote', $GLOBALS['whmcsApi']->action);
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
        $GLOBALS['whmcsApi']->stage = 'Accepted';
        $GLOBALS['whmcsApi']->subject = 'ABC123';
        $this->assertEquals('Accepted', $GLOBALS['whmcsApi']->stage);
        $this->assertEquals('ABC123', $GLOBALS['whmcsApi']->subject);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('quoteid', $result);
        $this->assertArrayHasKey('stage', $result);
        $this->assertArrayHasKey('subject', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
