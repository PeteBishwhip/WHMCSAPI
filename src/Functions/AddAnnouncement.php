<?php

namespace WHMCSAPI\Functions;

use WHMCSAPI\WHMCSAPI;

class AddAnnouncement
{
    public static $action = 'AddAnnouncement';

    const ATTRIBUTES = [
        'date', 'title', 'announcement', 'published',
    ];

    const REQUIRED_ATTRIBUTES = [
        'date', 'title', 'announcement',
    ];

    const ADDITIONAL_REQUIREMENTS = [
        'date' => 'datetime',
    ];
}
