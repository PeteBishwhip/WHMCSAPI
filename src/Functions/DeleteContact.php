<?php

namespace WHMCSAPI\Functions;

class DeleteContact
{
    public static $action = 'DeleteContact';

    public const ATTRIBUTES = [
        'contactid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'contactid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'contactid' => 'numeric',
    ];
}
