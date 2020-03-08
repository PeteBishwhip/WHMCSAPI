<?php

namespace WHMCSAPI\Functions;

class AddPayMethod
{
    public static $action = 'AddPayMethod';

    public const ATTRIBUTES = [
        'clientid', 'type', 'description', 'gateway_module_name', 'card_number',
        'card_expiry', 'card_start', 'card_issue_number', 'bank_name', 'bank_account_type',
        'bank_code', 'bank_account', 'set_as_default',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
        'type' => [
            'BankAccount', 'CreditCard', 'RemoteCreditCard',
        ],
        'card_number'  => 'numeric',
        'card_expiry'  => 'numeric',
        'card_start' => 'numeric',
        'card_issue_number' => 'numeric',
        'set_as_default'  => 'boolean',
    ];

    public const DEFAULTS = [
        'type' => 'CreditCard',
        'set_as_default' => false,
    ];
}
