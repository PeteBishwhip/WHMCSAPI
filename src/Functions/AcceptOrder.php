<?php

namespace WHMCSAPI\Functions;

class AcceptOrder
{
    public static $action = 'AcceptOrder';

    public const ATTRIBUTES = [
        'orderid', 'serverid', 'serviceusername', 'servicepassword',
        'registrar', 'sendregistrar', 'autosetup', 'sendemail',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'orderid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
