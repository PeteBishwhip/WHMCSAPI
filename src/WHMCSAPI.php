<?php

namespace WHMCSAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
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
    protected $responseType = 'json';
    public $action;

    public function __construct($apiIdentifier, $apiSecret, $whmcsUrl)
    {
        $this->apiIdentifier = $apiIdentifier;
        $this->apiSecret = $apiSecret;
        $this->whmcsUrl = $whmcsUrl . '/includes/api.php';
    }

    public function command($command)
    {
        $fqcommand = '\\WHMCSAPI\\Functions\\' . $command;
        if (class_exists($fqcommand)) {
            $this->selectedCommand = $fqcommand;
            $this->setAttributes();
        } else {
            throw new FunctionNotFound("API Function: '{$command}' not found.");
        }
    }

    protected function setAttributes()
    {
        if (defined($this->selectedCommand . '::DEFAULTS')) {
            $attributeDefaults = $this->selectedCommand::DEFAULTS;
        }
        foreach ($this->selectedCommand::ATTRIBUTES as $attribute) {
            if (isset($attributeDefaults) && array_key_exists($attribute, $attributeDefaults)) {
                $this->{$attribute} = $attributeDefaults[$attribute];
            } else {
                $this->{$attribute} = null;
            }
        }
        $this->action = $this->selectedCommand::$action;
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
            'action' => $this->action,
            'username' => $this->apiIdentifier,
            'password' => $this->apiSecret,
            'responsetype' => $this->responseType,
        ];

        foreach ($this->selectedCommand::ATTRIBUTES as $attribute) {
            $requiredAttributes = $this->selectedCommand::REQUIRED_ATTRIBUTES;
            $additionalRequirements = $this->selectedCommand::ADDITIONAL_REQUIREMENTS;

            if (in_array($attribute, $requiredAttributes)) {
                if (is_null($this->{$attribute})) {
                    throw new NotServiceable("{$attribute} is a required attribute. Not set.");
                }

                if ($this->{$attribute} === false) {
                    $this->{$attribute} = '0';
                } elseif ($this->{$attribute} === true) {
                    $this->{$attribute} = '1';
                }
            }

            // After checking if the attribute is required, if it's null, stop processing and
            // do not include it in the payload.
            if (is_null($this->{$attribute})) continue;

            if (array_key_exists($attribute, $additionalRequirements)) {
                if (
                    is_array($additionalRequirements[$attribute])
                    && !in_array($this->{$attribute}, $additionalRequirements[$attribute])
                ) {
                    throw new NotServiceable("{$this->{$attribute}} is not an acceptable value for {$attribute}.");
                } else {
                    if (
                        $additionalRequirements[$attribute] === 'datetime'
                        && $this->inputValidate('datetime', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$this->{$attribute}} is not a valid format for {$attribute}. "
                            . "Expected: Y-m-d H:i:s");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'date'
                        && $this->inputValidate('date', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$this->{$attribute}} is not a valid format for {$attribute}. "
                            . "Expected: Y-m-d H:i:s");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'array'
                        && $this->inputValidate('array', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$attribute} must be an array.");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'numeric'
                        && $this->inputValidate('numeric', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$attribute} must be an numerical value.");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'ipaddress'
                        && $this->inputValidate('ipaddress', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$attribute} must be a valid IP address.");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'email'
                        && $this->inputValidate('email', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$attribute} must be a valid email address.");
                    }
                    if (
                        $additionalRequirements[$attribute] === 'float'
                        && $this->inputValidate('float', $this->{$attribute})
                    ) {
                        throw new NotServiceable("{$attribute} must be a valid numerical value. (float)");
                    }
                }
            }

            $postData[$attribute] = $this->{$attribute};
        }

        try {
            $client = new Client();
            $response = $client->post($this->whmcsUrl, [
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

        return $this->lastResponse = $response->getBody()->getContents();
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

    public function setResponseType($type = 'json')
    {
        $this->responseType = $type;
    }

    public function inputValidate($type, $data)
    {
        $valid = false;
        switch ($type) {
            case 'ipaddress':
                $valid = (bool) (!filter_var($data, FILTER_VALIDATE_IP));
                break;
            case 'datetime':
                $valid = (bool) (!preg_match('(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})', $data));
                break;
            case 'date':
                $valid = (bool) (!preg_match('(\d{4}-\d{2}-\d{2})', $data));
                break;
            case 'numeric':
                $valid = (bool) (!is_numeric($data));
                break;
            case 'array':
                $valid = (bool) (!is_array($data));
                break;
            case 'email':
                $valid = (bool) (!filter_var($data, FILTER_VALIDATE_EMAIL));
                break;
            case 'float':
                $valid =  (bool) (is_numeric($data)) ? (!is_float($data + 0)) : true;
                break;
            default:
                $valid =  true;
                break;
        }
        return $valid;
    }
}
