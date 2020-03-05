<?php

namespace WHMCSAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
                        if ($additionalRequirements[$attribute] === 'datetime') {
                            if(!preg_match('(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})', $this->{$attribute})) {
                                throw new NotServiceable("{$this->{$attribute}} is not a valid format for {$attribute}. "
                                    . "Expected: Y-m-d H:i:s");
                            }
                        }
                        if ($additionalRequirements[$attribute] === 'array' && !is_array($this->{$attribute})) {
                            throw new NotServiceable("{$attribute} must be an array.");
                        }
                    }
                }
            }
            $postData[$attribute] = $this->{$attribute};
        }

        try {
            $client = new Client();
            $response = $client->request('POST', $this->whmcsUrl, [
                'form_params' => $postData,
            ]);
        } catch (RequestException $e) {
            if (strpos($e->getMessage(), 'message=Invalid IP')) {
                throw new NotServiceable('IP has not been whitelisted in WHMCS.');
            } elseif (strpos($e->getMessage(), 'message=Invalid Permissions')) {
                throw new NotServiceable('Your API Identifier does not have permission to use ' . $this->getCommand());
            }
            throw new Exception($e->getMessage());
        }

        return $this->lastResponse = $response;
    }

    public function reset()
    {
        return new self($this->apiIdentifier, $this->apiSecret, $this->whmcsUrl);
    }

    public function getCommand()
    {
        $command = explode('\\', $this->selectedCommand);
        end($command);
        $key = key($command);
        return $command[$key];
    }
}
