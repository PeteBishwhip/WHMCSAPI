<?php

namespace WHMCSAPI\Functions;

class AddTransaction
{
    public static $action = 'AddTransaction';

    public const ATTRIBUTES = [
        'paymentmethod', 'userid', 'invoiceid', 'transid', 'date', 'currencyid', 'description',
        'amountin', 'fees', 'amountout', 'rate', 'credit', 'allowduplicatetransid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'paymentmethod',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'userid'                => 'numeric',
        'invoiceid'             => 'numeric',
        'date'                  => 'date',
        'currencyid'            => 'numeric',
        'amountin'              => 'float',
        'fees'                  => 'float',
        'amountout'             => 'float',
        'rate'                  => 'float',
        'credit'                => 'boolean',
        'allowduplicatetransid' => 'boolean',
    ];

    public const DEFAULTS = [
        'allowduplicatetransid' => false,
    ];
}
