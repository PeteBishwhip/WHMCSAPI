<?php

namespace WHMCSAPI\Functions;

class AddProjectTask
{
    public static $action = 'AddProjectTask';

    public const ATTRIBUTES = [
        'projectid', 'duedate', 'adminid', 'task',
        'notes', 'completed', 'billed',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'projectid', 'duedate', 'task',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'projectid' => 'numeric',
        'duedate'   => 'datetime',
        'adminid'   => 'numeric',
        'completed' => 'boolean',
        'billed'    => 'boolean',
    ];

    public const DEFAULTS = [
        'completed' => false,
        'billed'    => false,
    ];
}
