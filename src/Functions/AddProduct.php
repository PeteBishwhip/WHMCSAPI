<?php

namespace WHMCSAPI\Functions;

class AddProduct
{
    public static $action = 'AddProduct';

    public const ATTRIBUTES = [
        'name', 'gid', 'type', 'stockcontrol', 'qty', 'paytype', 'hidden',
        'showdomainoptions', 'tax', 'isFeatured', 'proratabilling', 'description',
        'welcomeemail', 'proratadate', 'proratachargenextmonth', 'subdomain',
        'autosetup', 'module', 'servergroupid', 'configoption1', 'configoption2',
        'configoption3', 'configoption4', 'configoption5', 'configoption6',
        'order', 'pricing',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'name', 'gid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'gid' => 'numeric',
        'type' => [
            'hostingaccount', 'reselleraccount', 'server', 'other',
        ],
        'stockcontrol' => 'boolean',
        'qty' => 'numeric',
        'hidden' => 'boolean',
        'showdomainoptions' => 'boolean',
        'tax' => 'boolean',
        'isFeatured' => 'boolean',
        'proratabilling' => 'boolean',
        'welcomeemail' => 'numeric',
        'proratadate' => 'numeric',
        'proratachargenextmonth' => 'numeric',
        'autosetup' => [
            '', 'on', 'payment', 'order',
        ],
        'order' => 'numeric',
        'pricing' => 'array',
    ];

    public const DEFAULTS = [
        'autosetup' => '',
    ];
}
