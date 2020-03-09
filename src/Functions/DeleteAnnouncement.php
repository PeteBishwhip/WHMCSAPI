<?php

namespace WHMCSAPI\Functions;

class DeleteAnnouncement
{
    public static $action = 'DeleteAnnouncement';

    public const ATTRIBUTES = [
        'announcementid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'announcementid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'announcementid' => 'numeric',
    ];
}
