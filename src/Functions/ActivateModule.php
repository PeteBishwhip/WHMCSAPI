<?php

namespace WHMCSAPI\Functions;

class ActivateModule
{
    public static $action = 'ActivateModule';

    public const ATTRIBUTES = [
        'moduleType', 'moduleName', 'parameters',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'moduleType',
        'moduleName',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'moduleType' => [
            'gateway', 'server', 'addon', 'registrar',
        ],
    ];
}
