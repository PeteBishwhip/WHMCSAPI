<?php

namespace WHMCSAPI\Functions;

class CancelOrder
{
    public static $action = 'CancelOrder';

    public const ATTRIBUTES = [
        'orderid',
        'cancelsub',
        'noemail',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'orderid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'orderid' => 'numeric',
        'cancelsub' => 'boolean',
        'noemail' => 'boolean',
    ];
}
