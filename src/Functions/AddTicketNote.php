<?php

namespace WHMCSAPI\Functions;

class AddTicketNote
{
    public static $action = 'AddTicketNote';

    public const ATTRIBUTES = [
        'message',
        'ticketnum',
        'ticketid',
        'markdown',
        'attachments',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'message',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'ticketid' => 'numeric',
        'markdown' => 'boolean',
        'attachments' => 'array',
    ];
}
