<?php

namespace WHMCSAPI\Functions;

class ApplyCredit
{
    public static $action = 'ApplyCredit';

    public const ATTRIBUTES = [
        'invoiceid', 'amount', 'noemail',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'invoiceid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'invoiceid' => 'numeric',
        'amount'    => 'float',
        'noemail'   => 'boolean',
    ];

    public const DEFAULTS = [
        'noemail' => false,
    ];
}
