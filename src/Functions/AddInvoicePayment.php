<?php

namespace WHMCSAPI\Functions;

class AddInvoicePayment
{
    public static $action = 'AddInvoicePayment';

    public const ATTRIBUTES = [
        'invoiceid', 'transid', 'gateway',
        'date', 'amount', 'fees', 'noemail',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'invoiceid', 'transid', 'gateway',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'invoiceid' => 'numeric',
        'amount'    => 'float',
        'fees'      => 'float',
    ];
}
