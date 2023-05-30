<?php

namespace iamjohndev;

class AuditLogger
{
    private static $logDriver;
    private static $dbConnection;
    private static $logFormatter;
    private static $logsTableName;

    // Set the log storage driver
    public static function setLogDriver($driver)
    {
        self::$logDriver = $driver;
    }

    // Set the database connection
    public static function setDbConnection($dbConnection)
    {
        self::$dbConnection = $dbConnection;
    }

    // Set the log formatter
    public static function setLogFormatter($logFormatter)
    {
        self::$logFormatter = $logFormatter;
    }

    // Set the custom logs table name
    public static function setLogsTableName($tableName)
    {
        self::$logsTableName = $tableName;
    }

    // Log user interaction
    public static function log($userId, $action, $module)
    {
        $log = is_callable(self::$logFormatter) ? self::$logFormatter($userId, $action, $module) : self::generateLog($userId, $action, $module);

        if (self::$logDriver === 'file') {
            self::storeLogToFile($log);
        } elseif (self::$logDriver === 'database') {
            self::storeLogToDatabase($log);
        } else {
            throw new \Exception('Invalid log driver specified.');
        }
    }

    // Generate log data
    private static function generateLog($userId, $action, $module)
    {
        $timestamp = date('Y-m-d H:i:s');
        return "$timestamp | User ID: $userId | Action: $action | Module: $module";
    }

    // Store log to file
    private static function storeLogToFile($log)
    {
        $logFile = 'audit.log';

        // Create log file if it does not exist
        if (!file_exists($logFile)) {
            $result = file_put_contents($logFile, '');
            if ($result === false) {
                throw new \Exception('Failed to create log file.');
            }
        }

        if (!is_writable($logFile)) {
            throw new \Exception('Logs file is not writable.');
        }

        file_put_contents($logFile, $log . PHP_EOL, FILE_APPEND);
        echo "Log stored to file: $log" . PHP_EOL;
    }

    // Store log to database
    private static function storeLogToDatabase($log)
    {
        if (!self::$dbConnection) {
            throw new \Exception('Database connection is not set.');
        }

        if (!self::$logsTableName) {
            throw new \Exception('Logs table name is not set.');
        }

        // Code to store log to the custom logs table in the database
        self::$dbConnection->query("INSERT INTO ".self::$logsTableName." (log_entry) VALUES ('$log')");
        echo "Log stored to database: $log" . PHP_EOL;
    }

    // Get all logs
    public static function getAllLogs()
    {
        if (self::$logDriver === 'file') {
            // Code to retrieve logs from file
            return file_get_contents('audit.log');
        } elseif (self::$logDriver === 'database') {
            if (!self::$dbConnection) {
                throw new \Exception('Database connection is not set.');
            }

            if (!self::$logsTableName) {
                throw new \Exception('Logs table name is not set.');
            }

            // Code to retrieve logs from the custom logs table in the database
            return self::$dbConnection->query("SELECT * FROM ".self::$logsTableName)->fetch_all();
        } else {
            throw new \Exception('Invalid log driver specified.');
        }
    }

    // Clear all logs
    public static function clearLogs()
    {
        if (self::$logDriver === 'file') {
            if (!is_writable('audit.log')) {
                throw new \Exception('Logs file is not writable.');
            }

            // Code to clear logs from file
            file_put_contents('audit.log', '');
            echo "Logs cleared from file." . PHP_EOL;
        } elseif (self::$logDriver === 'database') {
            if (!self::$dbConnection) {
                throw new \Exception('Database connection is not set.');
            }

            if (!self::$logsTableName) {
                throw new \Exception('Logs table name is not set.');
            }

            // Code to clear logs from the custom logs table in the database
            self::$dbConnection->query("DELETE FROM ".self::$logsTableName);
            echo "Logs cleared from database." . PHP_EOL;
        } else {
            throw new \Exception('Invalid log driver specified.');
        }
    }
}
