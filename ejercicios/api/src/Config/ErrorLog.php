<?php

namespace App\Config;

class ErrorLog {

    public static function activateErrorLog(): void
    {
        error_reporting(E_ALL);
        ini_set('ignore_repeated_errors', true);
        ini_set('display_errors', false);
        ini_set('log_errors', true);
        ini_set('error_log', dirname(__DIR__) . '/Logs/php_error.log');
    }

}