<?php

namespace WHMCSAPI\Tests;

use PHPUnit\Framework\TestCase;
use WHMCSAPI\Exception\NotServiceable;

class BaseTest extends TestCase
{
    public static $apiIdentifier = 'randomValueNotRequired';
    public static $apiSecret = 'randomValueNotRequired';
    public static $testEnvironment = 'https://whmcs.peterbishop.rocks';

    public static function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
        $GLOBALS['whmcsApi'] = new \WHMCSAPI\WHMCSAPI(self::$apiIdentifier, self::$apiSecret, self::$testEnvironment);
    }

    public function testObjectInitialized()
    {
        $this->assertIsObject($GLOBALS['whmcsApi']);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        unset($GLOBALS['whmcsApi']);
    }
}
