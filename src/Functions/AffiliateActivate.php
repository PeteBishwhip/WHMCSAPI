<?php

namespace WHMCSAPI\Functions;

class AffiliateActivate
{
    public static $action = 'AffiliateActivate';

    public const ATTRIBUTES = [
        'userid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'userid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'userid' => 'numeric',
    ];
}
