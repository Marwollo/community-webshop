<?php
    namespace App\Models;

    use App\Utils\Logger;
    use App\Utils\Database;
    use App\Utils\Language;
    use Exception;
    use PDOException;

    class Product
    {
        protected $id;
        protected $name;
        protected $description;
        protected $price;
        protected $uploader_id;
        
        protected function __construct($id, $name, $description, $price, $uploader_id) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->uploader_id = $uploader_id;
        }

        public static function setupDatabase()
        {
            try {
                $db = new Database();
                $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/database/products_setup.sql");
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();
                $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/database/orders_setup.sql");
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();
                $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/database/order_items_setup.sql");
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->execute();
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function createProduct($name, $description, $price, $uploader_id) {
            try {
                if (!($price >= 0))
                    throw new Exception(Language::getField("invalidPrice"));

                $db = new Database();
                $stmt = $db->getConnection()->prepare("INSERT INTO products (name, description, price, uploader_id) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $description, $price, $uploader_id]);
                $product_id = $db->getConnection()->lastInsertId();

                return new Product($product_id, $name, $description, $price, $uploader_id);
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function getByID($id)
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
                $stmt->execute([$id]);
                
                $product = $stmt->fetch();
                if ($product == null)
                    return null;

                $product = new Product($product["id"], $product["name"], $product["description"], $product["price"], $product["uploader_id"]);
               
                return $product;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function getAll($search = "")
        {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("SELECT * FROM products WHERE name LIKE LOWER(?)");
                $stmt->execute(["%".$search."%"]);
                
                $products = array();
                foreach ($stmt->fetchAll() as $product) {
                    array_push($products, new Product($product["id"], $product["name"], $product["description"], $product["price"], $product["uploader_id"]));
                }
                return $products;
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public static function deleteById($id) {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("DELETE FROM products WHERE id = ?");
                $stmt->execute([$id]);
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setName($name) {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("UPDATE products SET name = ? WHERE id = ?");
                $stmt->execute([$name, $this->id]);   
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setDescription($description) {
            try {
                $db = new Database();
                $stmt = $db->getConnection()->prepare("UPDATE products SET description = ? WHERE id = ?");
                $stmt->execute([$description, $this->id]);   
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setPrice($price) {
            try {
                if (!($price >= 0))
                    throw new Exception(Language::getField("invalidPrice"));
                $db = new Database();
                $stmt = $db->getConnection()->prepare("UPDATE products SET price = ? WHERE id = ?");
                $stmt->execute([$price, $this->id]);   
            } catch (PDOException $e) {
                Logger::error($e->getMessage());
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function setThumbnail() {
            $file = $_FILES["thumbnail"];
            $target_dir = $_SERVER["DOCUMENT_ROOT"] . "/Uploads/";
            $imageFileType = strtolower(end(explode(".", $file["name"])));

            $target_file = $target_dir . "thumbnail-" . $this->id . ".jpg";
            
            Logger::log($target_file);
            
            if (getimagesize($file["tmpname"]) === false)
                throw new Exception(Language::getField("invalidUpload"));
            
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {

                throw new Exception(Language::getField("invalidUpload"));
            }
            
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                throw new Exception(Language::getField("serverError"));
            }
        }

        public function getID() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getUploader() {
            return User::getByID($this->uploader_id);
        }

        public function getUploaderID() {
            return $this->uploader_id;
        }

        public function view($type = "default") {
            switch ($type) {
                case "default":
                    include($_SERVER["DOCUMENT_ROOT"] . "/Views/product.php");
                    return;
                case "cart":
                    include($_SERVER["DOCUMENT_ROOT"] . "/Views/cart_product.php");
                    return;
                default:
                    include($_SERVER["DOCUMENT_ROOT"] . "/Views/product.php");
                    return;
            }
           
        }

    }
?>