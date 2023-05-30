# AuditLogger

Audit Logger is a simple PHP class that allows you to log user interactions in your application. You can configure the logging driver (file or database), database connection, and log formatter according to your needs.

## Installation
You can install Audit Logger using Composer by running the following command:

```bash
composer require iamjohndev/audit-logger
```

Replace your-vendor-name with your desired vendor name and your-package-name with the desired package name.

## Usage
Include the Composer autoloader in your PHP files where you want to use the AuditLogger class:

`require_once 'vendor/autoload.php';
`

Set the log storage driver and the database connection (if using the database driver) before using the AuditLogger:

```php
use iamjohndev\AuditLogger;

// Set the log storage driver
AuditLogger::setLogDriver('database');

// Set the database connection
$dbConnection = new mysqli('localhost', 'username', 'password', 'database_name');
AuditLogger::setDbConnection($dbConnection);
```

Set the log formatter (optional) if you want to customize the log entry format:

```php
AuditLogger::setLogFormatter(function($userId, $action) {
    // Custom log formatting logic
    return "User ID: $userId | Action: $action";
});

```

Start logging user interactions by calling the **log** method:
```php
// Log user interaction
$userId = 123;
$action = 'edit';
AuditLogger::log($userId, $action);

```

Retrieve all logs using the **getAllLogs** method:
```php
// Get all logs
$logs = AuditLogger::getAllLogs();
print_r($logs);

```

Clear all logs using the **clearLogs** method:
```php
// Clear all logs
AuditLogger::clearLogs();

```

### Database Configuration
If you're using the database log storage driver, make sure to configure the database connection by setting the appropriate values for the host, username, password, and database name in the database connection code:

```php
$dbConnection = new mysqli('localhost', 'username', 'password', 'database_name');

```

Replace '**localhost**', '**username**', '**password**', and '**database_name**' with the actual values for your database configuration.

#### Custom Logs Table (Optional)
If you want to use a custom table name for storing logs in the database, you can set it using the setLogsTableName method:
```php
AuditLogger::setLogsTableName('custom_logs_table');
```

Replace '**custom_logs_table**' with the desired name for your custom logs table.

### License
This project is licensed under the MIT License. See the **LICENSE** file for details.
