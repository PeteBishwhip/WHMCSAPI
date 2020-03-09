<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class CreateOAuthCredentialTest extends BaseTest
{
    public function testCanUseUpdateQuoteCommand()
    {
        $GLOBALS['whmcsApi']->command('CreateOAuthCredential');
        $this->assertEquals('CreateOAuthCredential', $GLOBALS['whmcsApi']->action);
    }

    public function testGrantTypeCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->grantType);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->grantType = 'single_sign_on';
        $GLOBALS['whmcsApi']->scope = 'clientarea:sso clientarea:billing_info clientarea:announcements';
        $GLOBALS['whmcsApi']->name = 'Test';
        $this->assertEquals('single_sign_on', $GLOBALS['whmcsApi']->grantType);
        $this->assertEquals('Test', $GLOBALS['whmcsApi']->name);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('grantType', $result);
        $this->assertArrayHasKey('scope', $result);
        $this->assertArrayHasKey('name', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
