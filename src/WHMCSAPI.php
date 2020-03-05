<?php

namespace WHMCSAPI;

use WHMCSAPI\Exception\FunctionNotFound;

class WHMCSAPI
{
    protected $apiIdentifier;
    protected $apiSecret;
    protected $selectedCommand;

    public function __construct($apiIdentifier, $apiSecret)
    {
        $this->apiIdentifier = $apiIdentifier;
        $this->apiSecret = $apiSecret;
    }

    public function command($command)
    {
        $command = '\WHMCSAPI\\' . $command;
        if (class_exists($command)) {
            $this->selectedCommand = $command;
            $this->setAttributes();
        } else {
            throw new FunctionNotFound("API Function: '{$command}' not found");
        }
    }

    protected function setAttributes()
    {
        foreach ($command::ATTRIBUTES as $attribute) {
            die($attribute);
        }
    }
}