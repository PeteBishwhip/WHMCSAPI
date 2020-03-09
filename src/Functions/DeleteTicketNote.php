<?php

namespace WHMCSAPI\Functions;

class DeleteTicketNote
{
    public static $action = 'DeleteTicketNote';

    public const ATTRIBUTES = [
        'noteid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'noteid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'noteid' => 'numeric',
    ];
}
