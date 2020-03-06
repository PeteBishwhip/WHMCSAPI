<?php

namespace WHMCSAPI\Functions;

class AddAnnouncement
{
    public static $action = 'AddAnnouncement';

    public const ATTRIBUTES = [
        'date', 'title', 'announcement', 'published',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'date', 'title', 'announcement',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'date' => 'datetime',
    ];
}
