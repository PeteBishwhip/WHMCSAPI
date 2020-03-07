<?php

namespace WHMCSAPI\Functions;

class AddCredit
{
    public static $action = 'AddCredit';

    public const ATTRIBUTES = [
        'clientid', 'description', 'amount',
        'date', 'adminid', 'type',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid', 'description', 'amount',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
        'amount'   => 'float',
        'date'     => 'date',
        'adminid'  => 'numeric',
        'type' => [
            'add', 'remove',
        ],
    ];

    public const DEFAULTS = [
        'type' => 'add',
    ];
}
