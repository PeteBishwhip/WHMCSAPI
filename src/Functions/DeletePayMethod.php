<?php

namespace WHMCSAPI\Functions;

class DeletePayMethod
{
    public static $action = 'DeletePayMethod';

    public const ATTRIBUTES = [
        'clientid', 'paymethodid', 'failonremotefailure',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid', 'paymethodid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
        'paymethodid' => 'numeric',
        'failonremotefailure' => 'boolean',
    ];

    public const DEFAULTS = [
        'failonremotefailure' => false,
    ];
}
