<?php

namespace WHMCSAPI\Functions;

class AcceptOrder
{
    public static $action = 'AcceptOrder';

    const ATTRIBUTES = [
        'orderid', 'serverid', 'serviceusername', 'servicepassword',
        'registrar', 'sendregistrar', 'autosetup', 'sendemail',
    ];

    const REQUIRED_ATTRIBUTES = [
        'orderid',
    ];

    const ADDITIONAL_REQUIREMENTS = [];
}
