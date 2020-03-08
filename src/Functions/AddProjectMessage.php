<?php

namespace WHMCSAPI\Functions;

class AddProjectMessage
{
    public static $action = 'AddProjectMessage';

    public const ATTRIBUTES = [
        'projectid', 'message', 'adminid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'projectid', 'message',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'projectid' => 'numeric',
        'adminid' => 'numeric',
    ];
}
