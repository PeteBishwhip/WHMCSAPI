<?php

namespace WHMCSAPI\Functions;

class AddContact
{
    public static $action = 'AddContact';

    public const ATTRIBUTES = [
        'clientid', 'firstname', 'lastname', 'companyname', 'email', 'address1', 'address2',
        'city', 'state', 'postcode', 'country', 'phonenumber', 'tax_id', 'password2',
        'generalemails', 'productemails', 'domainemails', 'invoiceemails', 'supportemails',
        'affiliateemails', 'permissions',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
