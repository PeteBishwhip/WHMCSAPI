<?php

namespace WHMCSAPI\Tests;

use PHPUnit\Framework\TestCase;
use WHMCSAPI\Exception\NotServiceable;

class BaseTest extends TestCase
{
    public static $apiIdentifier = 'jWgmIbNWJm8XSVzkWGrVyEPdukb8Y4C6';
    public static $apiSecret = 'wJ1Huc0CSRpruhsfMerI7WLiu6X5wsSZ';
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
