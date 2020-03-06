<?php

namespace WHMCSAPI\Functions;

class AddClientNote
{
    public static $action = 'AddClientNote';

    public const ATTRIBUTES = [
        'userid', 'notes', 'sticky',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'userid', 'notes',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'userid' => 'numeric',
    ];
}
