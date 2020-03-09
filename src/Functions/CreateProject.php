<?php

namespace WHMCSAPI\Functions;

class CreateProject
{
    public static $action = 'CreateProject';

    public const ATTRIBUTES = [
        'title', 'adminid', 'userid', 'status', 'created',
        'duedate', 'completed', 'ticketids', 'invoiceids',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'title', 'adminid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'adminid'   => 'numeric',
        'userid'    => 'numeric',
        'created'   => 'date',
        'duedate'   => 'date',
        'completed' => 'boolean',
    ];
}
