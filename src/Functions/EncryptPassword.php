<?php

namespace WHMCSAPI\Functions;

class EncryptPassword
{
    public static $action = 'EncryptPassword';

    public const ATTRIBUTES = [
        'password2',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'password2',
    ];

    public const ADDITIONAL_REQUIREMENTS = [];
}
