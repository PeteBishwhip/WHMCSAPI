<?php

namespace WHMCSAPI;

class AcceptOrder extends WHMCSAPI
{
    protected $action = 'AcceptOrder';

    const ATTRIBUTES = [
        'orderid', 'serverid', 'serviceusername', 'servicepassword',
        'registrar', 'sendregistrar', 'autosetup', 'sendemail',
    ];
}