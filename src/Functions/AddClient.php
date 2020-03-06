<?php

namespace WHMCSAPI\Functions;

class AddClient
{
    public static $action = 'AddClient';

    public const ATTRIBUTES = [
        'firstname', 'lastname', 'companyname', 'email', 'address1', 'address2',
        'city', 'state', 'postcode', 'country', 'phonenumber', 'tax_id', 'password2',
        'securityqid', 'securityqans', 'currency', 'groupid', 'customfields', 'language',
        'clientip', 'notes', 'marketingoptin', 'noemail', 'skipvalidation',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'firstname', 'lastname', 'email', 'address1', 'city',
        'state', 'postcode', 'country', 'phonenumber', 'password2',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'email' => 'email',
        'phonenumber' => 'numeric',
    ];
}
