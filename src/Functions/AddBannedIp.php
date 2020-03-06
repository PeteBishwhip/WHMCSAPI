<?php

namespace WHMCSAPI\Functions;

class AddBannedIp
{
    public static $action = 'AddBannedIp';

    public const ATTRIBUTES = [
        'ip', 'reason', 'days', 'expires',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'ip', 'reason', 'days',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'ip'   => 'ipaddress',
        'days' => 'numeric',
    ];
}
