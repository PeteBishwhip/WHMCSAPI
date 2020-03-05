<?php

namespace WHMCSAPI\Functions;

use WHMCSAPI\WHMCSAPI;

class AcceptOrder extends WHMCSAPI
{
    protected $action = 'AcceptOrder';

    const ATTRIBUTES = [
        'orderid', 'serverid', 'serviceusername', 'servicepassword',
        'registrar', 'sendregistrar', 'autosetup', 'sendemail',
    ];

    const REQUIRED_ATTRIBUTES = [
        'orderid',
    ];
    
    const ADDITIONAL_REQUIREMENTS = [];
}
