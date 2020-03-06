<?php


namespace WHMCSAPI\Tests\Functions;

use WHMCSAPI\Exception\NotServiceable;
use WHMCSAPI\Tests\BaseTest;

class AddAnnouncementTest extends BaseTest
{
    public function testCanUseActivateModuleCommand()
    {
        $GLOBALS['whmcsApi']->command('AddAnnouncement');
        $this->assertEquals('AddAnnouncement', $GLOBALS['whmcsApi']->action);
    }

    public function testRequiredAttributesNotSetFails()
    {
        $this->assertNull($GLOBALS['whmcsApi']->title);
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testAttributesCanBeSet()
    {
        $GLOBALS['whmcsApi']->title = 'This is a title!';
        $GLOBALS['whmcsApi']->announcement = 'This is my announcement!';
        $this->assertEquals('This is my announcement!', $GLOBALS['whmcsApi']->announcement);
    }

    public function testIncorrectDateFails()
    {
        $GLOBALS['whmcsApi']->date = date('Y-m-d H:i');
        $this->expectException(NotServiceable::class);
        $GLOBALS['whmcsApi']->execute();
    }

    public function testCanMakeAPICall()
    {
        // Finish test - Set date back to correct datetime
        $GLOBALS['whmcsApi']->date = date('Y-m-d H:i:s');
        $result = $GLOBALS['whmcsApi']->execute();
        $this->assertStringContainsString('{"result":', $result);
    }
}
