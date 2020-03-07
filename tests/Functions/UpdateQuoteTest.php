<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class UpdateQuoteTest extends BaseTest
{
    public function testCanUseUpdateQuoteCommand()
    {
        $GLOBALS['whmcsApi']->quoteid = 1;
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
        $this->assertStringContainsString('{"result":', $result);
    }
}
