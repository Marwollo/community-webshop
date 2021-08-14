<?php

    namespace App\Utils;
    use PDO, PDOException;
    use App\Config\Config;

    class Database
    {
        private $connection_string;
        private $host;
        private $username;
        private $password;
        private $options;
        private $charset;
        private $db_name;
        private $db;

        public function __construct($host = Config::HOST, $username = Config::USERNAME, $password = Config::PASSWORD, $db_name = Config::DB_NAME, $charset = Config::CHARSET, $options = Config::DB_OPTIONS) {
            try {
                
                $this->host = $host;
                $this->username = $username;
                $this->password = $password;
                $this->db_name = $db_name;
                $this->options = $options;
                $this->charset = $charset;
                $this->connection_string = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset . ";";
                $this->db = new PDO($this->connection_string, $this->username, $this->password, $this->options);

            } catch (PDOException $e) {
                die("Error while creating database connection. Error message: " . $e->getMessage());
            }
        }

        public function getConnection() {
            if ($this->db)
                return $this->db;
            else
                die("No connection available."); 
        }
    }
?>