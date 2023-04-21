# Audit Logger
Audit Logger is a simple PHP class that allows you to log user interactions in your application. You can configure the logging driver (file or database), database connection, and log formatter according to your needs.

## Installation
You can install Audit Logger using Composer by running the following command:

`composer require iamjohndev/audit-logger:dev-main`

## Usage
```php
use iamjohndev\AuditLogger;

// Set the log driver (either 'file' or 'database')
AuditLogger::setLogDriver('file');

// Set the database connection (if using 'database' log driver)
$dbConnection = // Your database connection here
AuditLogger::setDbConnection($dbConnection);

// Log user interaction
$userId = 123;
$action = 'login';
AuditLogger::log($userId, $action);

// Retrieve all logs
$logs = AuditLogger::getAllLogs();
print_r($logs); // Display all logs

// Clear all logs
AuditLogger::clearLogs();
```

## Configuration
Audit Logger provides three configuration methods:

- **setLogDriver($driver): **Set the log driver to either 'file' or 'database' (required).
- **setDbConnection($dbConnection):** Set the database connection (required if using 'database' log driver).
- **setLogFormatter($logFormatter):** Set a custom log formatter as a callback function (optional).


## Methods
- **log($userId, $action):** Log user interaction with a given user ID and action.
- **getAllLogs():** Retrieve all logs from the configured storage medium (file or database).
- **clearLogs()**: Clear all logs from the configured storage medium.


## Customization
You can customize the log formatter callback function to format the log entry string according to your desired format. By default, Audit Logger uses a simple log entry format of "User ID: {userId} performed action: {action}", but you can modify this format to suit your needs.

## License
Audit Logger is released under the MIT License.

## Contribution
If you would like to contribute to Audit Logger, please open an issue or submit a pull request on the GitHub repository.

## Credits
**Audit Logger** is developed and maintained by **IamJohnDev.**

## Disclaimer
Audit Logger is provided as-is and is not responsible for any misuse or damages caused by the use of this library. Please use it responsibly and follow best practices for logging user interactions in your application.
