<?php

namespace WHMCSAPI\Functions;

class DecryptPassword
{
    public static $action = 'DecryptPassword';

    public const ATTRIBUTES = [
        'password2',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'password2',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
