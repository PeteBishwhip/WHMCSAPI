<?php

namespace WHMCSAPI\Functions;

class DomainGetNameservers
{
    public static $action = 'DomainGetNameservers';

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
