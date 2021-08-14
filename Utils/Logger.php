<?php

namespace App\Utils;

/**
 * @package Logger utility for logging information during the runtime.
 *
 */
class Logger
{
    /*
        Developer's side note:
        Each log level has its own file writing procedure in case you'd want to
        modify it and change the way of a specific logging level is being executed. 
    */

    /**
     * Logs a debug message to the file system.
     * 
     * @param string $message A message to be logged. 
     */
    static function log($message)
    {
        $name = "LOG-DEBUG-" . date("Y-M-d\TH-i-s");

        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/Logs/debug/" . $name . ".log", "a+");
        
        fwrite($file, $message);
        fclose($file);
    }

    /**
     * Logs an error message to the file system.
     * 
     * @param string $message A message to be logged. 
     */
    static function error($message)
    {
        $name = "LOG-ERROR-" . date("Y-M-d\TH-i-s");
    
        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/Logs/error/" . $name . ".log", "a+");
       
        fwrite($file, $message);
        fclose($file);
    }

    /**
     * Logs a warning message to the file system.
     * 
     * @param string $message A message to be logged. 
     */
    static function warning($message)
    {
        $name = "LOG-WARNING-" . date("Y-M-d\TH-i-s");

        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/Logs/warning/" . $name . ".log", "a+");
        
        fwrite($file, $message);
        fclose($file);
    }

    /**
     * Logs an info message to the file system.
     * 
     * @param string $message A message to be logged. 
     */
    static function info($message)
    {
        $name = "LOG-INFO-" . date("Y-M-d\TH-i-s");

        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/Logs/info/" . $name . ".log", "a+");
       
        fwrite($file, $message);
        fclose($file);
    }
}
