<?php
    use App\Utils\Database;
    use App\Utils\Language;
    use App\Utils\Logger;

    if (!isset($_POST["first_name"]) || !isset($_POST["last_name"]) || !isset($_POST["phone"]) || !isset($_POST["message"])) {
        header("location:/");
        exit();
    }
    try {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];
        if (strlen($message) == 0 || strlen($message) > 512){
            throw new Exception(Language::getField("longMessage"));
        }
        if(!is_numeric($phone)){
            throw new Exception(Language::getField("invalidPhone"));
        }
        if (!preg_match("/^[a-zA-Z-čšćđš]*$/", $first_name)){
            throw new Exception(Language::getField("invalidFirstName"));
        }
        if (!preg_match("/^[a-zA-Z-čšćđš]*$/", $last_name)){
            throw new Exception(Language::getField("invalidLastName"));
        }
        $db = new Database();
        $sql = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/database/contact_messages.sql");
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();
        $stmt = $db->getConnection()->prepare("INSERT INTO contact_messages (first_name, last_name, phone, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone, $message]);
        header("location:/contact?message=" . Language::getField("messageSent"));
    } catch (Exception $e) {
        Logger::error($e->getMessage());
        header("location:/contact?message=" . $e->getMessage());
    }
?>