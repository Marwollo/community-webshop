<?php

    namespace App\Models;

    use App\Utils\Logger;
    use App\Utils\Database;
    use App\Utils\Language;

    use Exception;
    use PDOException;

    class User
    {
        protected $id;
        protected $first_name;
        protected $last_name;
        protected $email;
        protected $password;
        protected $status;

        /** 
         *  Get an User instance from the database by the corresponding ID. 
         * 
         * @param string|int $id The ID of the User that should be retrieved. The ID can have two types, based on the indexing type (by a string or by an integer).
         * 
         * @return User
         */

        protected function __construct($id, $first_name, $last_name, $email, $password) 
        {
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->password = $password;
        }


        public static function setupDatabase()
        {
            try {
                $db = new Database();
                $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/database/users_setup.sql");
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function getByID($id)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
                $stmt->execute([$id]);
                
                $user = $stmt->fetch();
                if ($user == null)
                    return null;

                $user = new User($user["id"], $user["first_name"], $user["last_name"], $user["email"], $user["password"]);
               
                return $user;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function getByEmail($email)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                
                $user = $stmt->fetch();
                if ($user == null)
                    return null;

                $user = new User($user["id"], $user["first_name"], $user["last_name"], $user["email"], $user["password"]);
               
                return $user;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            } 
        }

        public static function createUser($first_name, $last_name, $email, $password)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                
                $user = $stmt->fetch();
                if ($user != null)
                    throw new Exception(Language::getField("existsEmail"));
                
                if (!preg_match("/^[a-zA-Z-čšćđš]*$/", $first_name)){
                    throw new Exception(Language::getField("invalidFirstName"));
                }
                if (!preg_match("/^[a-zA-Z-čšćđš]*$/", $last_name)){
                    throw new Exception(Language::getField("invalidLastName"));
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    throw new Exception(Language::getField("invalidEmail"));
                }
                if (strlen($password) < 5) { 
                    throw new Exception(Language::getField("invalidPassword"));
                }
                $hashed = password_hash($password, PASSWORD_BCRYPT);
            
                $stmt = $db->getConnection()->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, $hashed]);
                $id = $db->getConnection()->lastInsertId();

                return new User($id, $first_name, $last_name, $email, $hashed);
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                die($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function getStatusForID($id) {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT status FROM users WHERE id = ?");
                $stmt->execute([$id]);
                $data = $stmt->fetch();

                return $data["status"];
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError")); 
            }
        }

        public static function verifyAccount($email, $password)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                
                $user = $stmt->fetch();
                if ($user == null)
                    throw new Exception(Language::getField("invalidLogin"));
                if (password_verify($password, $user["password"])) {
                    return new User($user["id"], $user["first_name"], $user["last_name"], $user["email"], $user["password"]);
                }
                throw new Exception(Language::getField("invalidLogin"));
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setFirstName($first_name)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("UPDATE users SET first_name = ? WHERE id = ?");
                
                if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)){
                    throw new Exception(Language::getField("invalidFirstName"));
                }
                $stmt->execute([$first_name, $this->id]);
                $this->first_name = $first_name;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setLastName($last_name)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("UPDATE users SET last_name = ? WHERE id = ?");
                
                if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)){
                    throw new Exception(Language::getField("invalidLastName"));
                }
                $stmt->execute([$last_name, $this->id]);
                $this->last_name = $last_name;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setEmailAddress($email)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                
                $user = $stmt->fetch();
                if ($user != null)
                    throw new Exception(Language::getField("existsEmail"));
                
                $stmt = $db->getConnection()->prepare("UPDATE users SET email = ? WHERE id = ?");
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    throw new Exception(Language::getField("invalidEmail"));
                }
                $stmt->execute([$email, $this->id]);
                $this->email = $email;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function getID() {
            return $this->id;
        }

        public function getFirstName() {
            return $this->first_name;
        }

        public function getLastName() {
            return $this->last_name;
        }

        public function getFullName() {
            return $this->first_name . " ". $this->last_name;
        }

        public function getEmailAddress() {
            return $this->email_address;
        }

       
    }

?>