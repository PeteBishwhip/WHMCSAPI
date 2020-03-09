<?php

namespace WHMCSAPI\Functions;

class DeleteQuote
{
    public static $action = 'DeleteQuote';

    public const ATTRIBUTES = [
        'quoteid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'quoteid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'quoteid' => 'numeric',
    ];
}
