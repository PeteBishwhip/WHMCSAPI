<?php

namespace WHMCSAPI\Functions;

class DeleteClient
{
    public static $action = 'DeleteClient';

    public const ATTRIBUTES = [
        'clientid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
    ];
}
