<?php

namespace WHMCSAPI\Functions;

class CloseClient
{
    public static $action = 'CloseClient';

    public const ATTRIBUTES = [
        'clientid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
