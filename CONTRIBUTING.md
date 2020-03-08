# Contributing

Thank you for considering contributing to the WHMCSAPI project.

Before contributing, please ensure you read the following:

* All code must adhere to [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards.
* All submissions should also include any relevant test file updates or additions.
* All tests should be written for PHPUnit.
* Updates intended to enhance the WHMCS API beyond it's original capabilities will not be accepted.
* Only one issue/feature should be addressed per Pull Request (PR)
* Only Pull Request up to date with master will be accepted. Ensure you're branch is up to date before submission.

## Local Testing
If you would like to run the tests locally before pushing your changes, update the details in `tests/BaseTest` with 
your own WHMCS credentials. Using ours will not work and the tests will fail as the test environment is strictly 
restricted to Travis-CI IP addresses only.

To test:
```bash
composer global require phpunit/phpunit
composer global require "squizlabs/php_codesniffer=*"

phpunit tests
phpcs --standard=PSR12 src
```

Thanks again for taking the time to contribute.
