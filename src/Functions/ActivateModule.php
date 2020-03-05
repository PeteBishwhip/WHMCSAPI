<?php

namespace WHMCSAPI\Functions;

use WHMCSAPI\WHMCSAPI;

class ActivateModule extends WHMCSAPI
{
    protected $action = 'ActivateModule';

    const ATTRIBUTES = [
        'moduleType', 'moduleName', 'parameters',
    ];

    const REQUIRED_ATTRIBUTES = [
        'moduleType',
        'moduleName',
    ];

    const ADDITIONAL_REQUIREMENTS = [
        'moduleType' => [
            'gateway', 'server', 'addon', 'registrar',
        ],
    ];
}
