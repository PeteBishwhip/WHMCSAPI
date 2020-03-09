<?php

namespace WHMCSAPI\Functions;

class DeleteTicket
{
    public static $action = 'DeleteTicket';

    public const ATTRIBUTES = [
        'ticketid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'ticketid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'ticketid' => 'numeric',
    ];
}
