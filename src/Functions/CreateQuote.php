<?php

namespace WHMCSAPI\Functions;

class CreateQuote
{
    public static $action = 'CreateQuote';

    public const ATTRIBUTES = [
        'subject', 'stage', 'validuntil', 'datecreated', 'lineitems', 'userid',
        'firstname', 'lastname', 'companyname', 'email', 'address1', 'address2',
        'city', 'state', 'postcode', 'country', 'phonenumber', 'tax_id', 'currency',
        'proposal', 'customernotes', 'adminnotes',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'subject', 'stage',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'stage'       => [
            'Draft', 'Delivered', 'On Hold', 'Accepted', 'Lost', 'Dead',
        ],
        'validuntil'  => 'date',
        'datecreated' => 'date',
        'lineitems'   => 'base64serializedarray',
        'userid'      => 'numeric',
        'phonenumber' => 'numeric',
        'currency'    => 'numeric',
    ];
}
