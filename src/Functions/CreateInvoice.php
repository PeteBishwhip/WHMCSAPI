<?php

namespace WHMCSAPI\Functions;

class CreateInvoice
{
    public static $action = 'CreateInvoice';

    public const ATTRIBUTES = [
        'userid', 'status', 'draft', 'sendinvoice', 'paymentmethod', 'taxrate', 'taxrate2', 'date',
        'duedate', 'notes', 'itemdescription', 'itemamount', 'itemtaxed', 'autoapplycredit',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'userid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'userid'      => 'numeric',
        'draft'       => 'boolean',
        'sendinvoice' => 'boolean',
        'taxrate'     => 'float',
        'taxrate2'    => 'float',
        'date'        => 'date',
        'duedate'     => 'date',
    ];

    public const INCREMENTAL_ATTRIBUTES = [
        'itemdescription' => 10,
        'itemamount'      => 10,
        'itemtaxed'       => 10,
    ];
}
