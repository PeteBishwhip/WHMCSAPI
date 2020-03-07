<?php

namespace WHMCSAPI\Functions;

class UpdateQuote
{
	public static $action = 'UpdateQuote';

	public const ATTRIBUTES = [
		'quoteid',
		'subject',
		'stage',
		'validuntil',
		'datecreated',
		'lineitems',
		'userid',
		'firstname',
		'lastname',
		'companyname',
		'email',
		'address1',
		'address2',
		'city',
		'state',
		'country',
		'phonenumber',
		'tax_id',
		'currency',
		'proposal',
		'customernotes',
		'adminnotes',
	];

	public const REQUIRED_ATTRIBUTES = [
		'quoteid',
	];

	public const ADDITIONAL_REQUIREMENTS = [
		'quoteid' => 'numeric',
		'lineitems' => 'array',
		'userid' => 'numeric',
		'currency' => 'numeric',
	];
}
