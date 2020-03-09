<?php

namespace WHMCSAPI\Functions;

class DeleteOAuthCredential
{
    public static $action = 'DeleteOAuthCredential';

    public const ATTRIBUTES = [
        'credentialId',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'credentialId',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'credentialId' => 'numeric',
    ];
}
