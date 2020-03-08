<?php

namespace WHMCSAPI\Functions;

class AddTicketReply
{
    public static $action = 'AddTicketReply';

    public const ATTRIBUTES = [
        'ticketid', 'message', 'markdown', 'clientid', 'contactid', 'adminusername',
        'name', 'email', 'status', 'noemail', 'customfields', 'attachments',

    ];

    public const REQUIRED_ATTRIBUTES = [
        'ticketid', 'message',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'ticketid'    => 'numeric',
        'markdown'    => 'boolean',
        'clientid'    => 'numeric',
        'contactid'   => 'numeric',
        'noemail'     => 'boolean',
        'attachments' => 'array',
    ];
}
