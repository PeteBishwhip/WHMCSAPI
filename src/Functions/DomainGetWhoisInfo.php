<?php

namespace WHMCSAPI\Functions;

class DomainGetWhoisInfo
{
    public static $action = 'DomainGetWhoisInfo';

    public const ATTRIBUTES = [
        'domainid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'domainid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'domainid' => 'numeric',
    ];
}
