<?php

namespace WHMCSAPI\Functions;

class CreateOAuthCredential
{
    public static $action = 'CreateOAuthCredential';

    public const ATTRIBUTES = [
        'grantType', 'scope', 'name', 'serviceid',
        'description', 'logoUri', 'redirectUri',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'grantType', 'scope',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'grantType' => [
            'authorization_code', 'single_sign_on',
        ],
        'serviceid' => 'numeric',
    ];
}
