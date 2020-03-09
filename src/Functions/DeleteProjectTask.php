<?php

namespace WHMCSAPI\Functions;

class DeleteProjectTask
{
    public static $action = 'DeleteProjectTask';

    public const ATTRIBUTES = [
        'projectid', 'taskid',
    ];

    public const REQUIRED_ATTRIBUTES = [
        'projectid', 'taskid',
    ];

    public const ADDITIONAL_REQUIREMENTS = [
        'projectid' => 'numeric',
        'taskid' => 'numeric',
    ];
}
