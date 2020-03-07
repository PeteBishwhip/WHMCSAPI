<?php

namespace WHMCSAPI\Functions;

class AddOrder
{
    public static $action = 'AddOrder';

    public const ATTRIBUTES = [
        'clientid', 'paymentmethod', 'pid', 'domain', 'billingcycle', 'domaintype',
        'regperiod', 'eppcode', 'nameserver1', 'nameserver2', 'nameserver3', 'nameserver4',
        'nameserver5', 'customfields', 'configoptions', 'priceoverride', 'affid', 'noinvoice',
        'noinvoiceemail', 'noemail', 'addons', 'hostname', 'ns1prefix', 'ns2prefix', 'rootpw',
        'contactid', 'dnsmanagement', 'domainfields', 'emailforwarding', 'idprotection',
        'domainpriceoverride', 'domainrenewoverride', 'domainrenewals', 'clientip', 'addonid',
        'serviceid', 'addonids', 'serviceids',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'clientid', 'paymentmethod',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'clientid' => 'numeric',
        'pid'    => 'array',
        'domain' => 'array',
        'billingcycle' => 'array',
        'domaintype' => 'array',
        'regperiod' => 'array',
        'eppcode' => 'array',
        'customfields' => 'array',
        'configoptions' => 'array',
        'priceoverride' => 'array',
        'addons' => 'array',
        'hostname' => 'array',
        'ns1prefix' => 'array',
        'ns2prefix' => 'array',
        'rootpw' => 'array',
        'contactid' => 'numeric',
        'dnsmanagement' => 'array',
        'domainfields' => 'array',
        'emailforwarding' => 'array',
        'idprotection' => 'array',
        'domainpriceoverride' => 'array',
        'domainrenewoverride' => 'array',
        'domainrenewals' => 'array',
        'clientip' => 'ipaddress',
        'addonid' => 'numeric',
        'serviceid' => 'numeric',
        'addonids' => 'array',
        'serviceids' => 'array',
    ];
}
