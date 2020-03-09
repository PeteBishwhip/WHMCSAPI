<?php

namespace WHMCSAPI\Functions;

class DeactivateModule
{
    public static $action = 'DeactivateModule';

    public const ATTRIBUTES = [
        'moduleType', 'moduleName',
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
