<?php

namespace WHMCSAPI;

use WHMCSAPI\Exception\Exception;
use WHMCSAPI\Exception\FunctionNotFound;
use WHMCSAPI\Exception\NotServiceable;

class WHMCSAPI
{
    protected $apiIdentifier;
    protected $apiSecret;
    protected $selectedCommand;
    protected $whmcsUrl;
    protected $lastResponse;

    public function __construct($apiIdentifier, $apiSecret, $whmcsUrl)
    {
        $this->apiIdentifier = $apiIdentifier;
        $this->apiSecret = $apiSecret;
        $this->whmcsUrl = $whmcsUrl . '/includes/api.php';
    }

    public function command($command)
    {
        $fqcommand = '\WHMCSAPI\Functions\\' . $command;
        if (class_exists($fqcommand)) {
            $this->selectedCommand = $fqcommand;
            $this->setAttributes();
        } else {
            throw new FunctionNotFound("API Function: '{$command}' not found.");
        }
    }

    protected function setAttributes()
    {
        foreach ($this->selectedCommand::ATTRIBUTES as $attribute) {
            $this->{$attribute} = null;
        }
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    public function execute()
    {
        if (is_null($this->selectedCommand)) {
            throw new NotServiceable('No command specified.');
        }

        $postData = [
            'action' => $this->selectedCommand,
            'username' => $this->apiIdentifier,
            'password' => $this->apiSecret,
        ];

        foreach ($this->selectedCommand::ATTRIBUTES as $attribute) {
            $requiredAttributes = $this->selectedCommand::REQUIRED_ATTRIBUTES;
            $additionalRequirements = $this->selectedCommand::ADDITIONAL_REQUIREMENTS;

            if (in_array($attribute, $requiredAttributes)) {
                if ($this->{$attribute} === null) {
                    throw new NotServiceable("{$attribute} is a required attribute. Not set.");
                }
                if (array_key_exists($attribute, $additionalRequirements)) {
                    if (is_array($additionalRequirements[$attribute]) && !in_array($this->{$attribute}, $additionalRequirements[$attribute])) {
                        throw new NotServiceable("{$this->{$attribute}} is not an acceptable value for {$attribute}.");
                    } else {
                        // @TODO - Add additional requirement types
                    }
                }
            }
            $postData[$attribute] = $this->{$attribute};
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->whmcsUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);

        return $this->lastResponse = $response;
    }

    public function reset()
    {
        return new self($this->apiIdentifier, $this->apiSecret, $this->whmcsUrl);
    }
}
