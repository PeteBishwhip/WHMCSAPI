<?php

namespace WHMCSAPI\Functions;

class DeleteOrder
{
    public static $action = 'DeleteOrder';

    public const ATTRIBUTES = [
        'orderid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'orderid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'orderid' => 'numeric',
    ];
}
