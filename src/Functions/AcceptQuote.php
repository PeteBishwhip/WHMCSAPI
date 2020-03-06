<?php

namespace WHMCSAPI\Functions;

class AcceptQuote
{
    public static $action = 'AcceptQuote';

    public const ATTRIBUTES = [
        'quoteid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'quoteid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
