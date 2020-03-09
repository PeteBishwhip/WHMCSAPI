<?php

namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class DeleteOAuthCredentialTest extends BaseTest
{

    public function testCanUseDeleteOAuthCredentialCommand()
    {
        $GLOBALS['whmcsApi']->command('DeleteOAuthCredential');
        $this->assertEquals('DeleteOAuthCredential', $GLOBALS['whmcsApi']->action);
    }

    public function testNoIDCauseException()
    {
        $this->assertNull($GLOBALS['whmcsApi']->credentialId);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->credentialId = 1;
        $this->assertEquals(1, $GLOBALS['whmcsApi']->credentialId);
    }

    public function testCanMakeAPICall()
    {
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertJson($result);
        $result = (json_decode($result, true))['postData'];
        $this->assertArrayHasKey('credentialId', $result);
        unset($result['username'], $result['password'], $result['responsetype']);
        foreach ($result as $attribute => $value) {
            $this->assertEquals($GLOBALS['whmcsApi']->{$attribute}, $value);
        }
    }
}
