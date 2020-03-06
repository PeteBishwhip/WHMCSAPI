<?php

namespace WHMCSAPI\Functions;

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
