<?php

namespace WHMCSAPI\Functions;

use WHMCSAPI\WHMCSAPI;

class AcceptQuote extends WHMCSAPI
{
    protected $action = 'AcceptQuote';

    const ATTRIBUTES = [
        'quoteid',
    ];

    const REQUIRED_ATTRIBUTES = [
        'quoteid',
    ];

    const ADDITIONAL_REQUIREMENTS = [];
}
