<?php

namespace WHMCSAPI\Functions;

class CapturePayment
{
    public static $action = 'CapturePayment';

    public const ATTRIBUTES = [
        'invoiceid', 'cvv',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'invoiceid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'invoiceid' => 'numeric',
        'cvv' => 'numeric',
    ];
}
