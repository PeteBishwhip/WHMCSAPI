<?php

namespace WHMCSAPI\Functions;

class AddBannedIp
{
    public static $action = 'AddBannedIp';

    const ATTRIBUTES = [
        'ip', 'reason', 'days', 'expires',
    ];

    const REQUIRED_ATTRIBUTES = [
        'ip', 'reason', 'days',
    ];

    const ADDITIONAL_REQUIREMENTS = [
        'ip'   => 'ipaddress',
        'days' => 'numeric',
    ];
}
