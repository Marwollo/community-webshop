<?php
    namespace App\Config;
    use PDO;

    abstract class Config {
        const HOST = "localhost";
        const DB_NAME = "furnifuture";
        const CHARSET = "utf8mb4";
        const USERNAME = "root";
        const PASSWORD = "";
        const DB_OPTIONS =  [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        const LANGUAGE = "sr_RS";
    }
    
?>