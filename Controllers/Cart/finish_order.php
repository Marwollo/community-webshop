<?php
    use App\Utils\Database;
    use App\Utils\Language;
    use App\Utils\Logger;

    if (!isset($_POST["address"]) || !isset($_SESSION["id"]) || !isset($_SESSION["cart"])) {
        header("location:/");
        exit();
    }
    try {
        $db = new Database();
        $stmt = $db->getConnection()->prepare("INSERT INTO orders (order_address, order_client) VALUES (?, ?)");
        $stmt->execute([$_POST["address"], $_SESSION["id"]]);
        $order_id = $db->getConnection()->lastInsertId();

        $stmt = $db->getConnection()->prepare("INSERT INTO order_items (product_id, product_price, product_quantity, order_id) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION["cart"] as $id => $item) {
            $stmt->execute([$id, $item["price"], $item["quantity"], $order_id]);
        }
        $_SESSION["cart"] = array();
        header("location:/?message=" . Language::getField("checkoutDone"));
    } catch (Exception $e) {
        Logger::error($e->getMessage());
        header("location:/?message=" . Language::getField("serverError"));
    }
?>