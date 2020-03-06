# WHMCSAPI - The WHMCS, PHP API Wrapper
[![Build Status](https://travis-ci.org/PeteBishwhip/WHMCSAPI.svg?branch=master)](https://travis-ci.org/PeteBishwhip/WHMCSAPI)

This project is simple. It is an object-oriented library of the WHMCS API functions.
To use this wrapper is simple.

# Requirements
- PHP 7.3 (It may work on lower. I only test on PHP 7.3 due to dev-dependencies)
- Composer
- WHMCS Installation (and License!) - [Buy Here](https://www.whmcs.com/members/aff.php?aff=40067)

## Usage
First, import the library:
```bash
composer require PeteBishwhip/WHMCSAPI
```

After you have imported the library, initialize the wrapper by providing three values.

| Variable       | Description                                          |
|:-------------- |:----------------------------------------------------:|
| $apiIdentifier | Your API Identifier                                  |
| $apiSecret     | Your API Secret                                      |
| $whmcsUrl      | Your WHMCS URL (e.g. https://example.com/whmcs/)     |

```php
use src\WHMCSAPI;

// $whmcsApi = new WHMCSAPI('abc123', '123cba', 'https://example.com/whmcs/');
$whmcsApi = new WHMCSAPI($apiIdentifier, $apiSecret, $whmcsUrl);
```

After initializing the library, use `command` to set the API command you want to use:

```php
try {
    $whmcsApi->command('AcceptOrder');
} catch (\WHMCSAPI\Exception\FunctionNotFound $e) {
    // Perform error handling here
    // You can retrieve the error with
    // $e->getMessage();
}
```
If the command is not available, a `\WHMCSAPI\Exception\FunctionNotFound` exception will be thrown to allow for catching errors.

From there, you can set any variables as documented in the WHMCS Developer Documentation:

```php
$whmcsApi->orderid = 25;
```

When ready, you can finally execute the command:
```php
$result = $whmcsApi->execute();
```

## Contributing
Please feel free to contribute. A proper "Contributing" guide will be created in due course.
