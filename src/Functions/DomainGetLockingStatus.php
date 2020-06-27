<?php

namespace WHMCSAPI\Functions;

class DomainGetLockingStatus
{
    public static $action = 'DomainGetLockingStatus';

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
