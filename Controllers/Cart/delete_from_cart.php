<?php
    use App\Models\Product;

    $id = $_GET["id"];
    if (!isset($_GET["id"])) {
        header("location:/");
        exit();
    }

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    if ($_SESSION["cart"][$id]["quantity"] == 1)
        unset($_SESSION["cart"][$id]);
    else $_SESSION["cart"][$id]["quantity"] = $_SESSION["cart"][$id]["quantity"] - 1;
        
    header("location:/");
?>