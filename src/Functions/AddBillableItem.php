<?php

namespace WHMCSAPI\Functions;

class AddBillableItem
{
    public static $action = 'AddBillableItem';

    public const ATTRIBUTES = [
        'clientid', 'description', 'amount', 'invoiceaction',
        'recur', 'recurcycle', 'recurfor', 'duedate', 'hours',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid', 'description', 'amount',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
        'invoiceaction' => [
            'noinvoice', 'nextcron', 'nextinvoice', 'duedate', 'recur',
        ],
        'recurcycle' => [
            'Days', 'Weeks', 'Months', 'Years',
        ],
    ];
}
