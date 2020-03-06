<?php

namespace WHMCSAPI\Functions;

class AddCancelRequest
{
    public static $action = 'AddCancelRequest';

    public const ATTRIBUTES = [
        'serviceid', 'type', 'reason'
    ];

    public const REQUIRED_ATTRIBUTES = [
        'serviceid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'serviceid' => 'numeric',
        'type' => [
            'Immediate', 'End of Billing Period',
        ],
    ];
}
