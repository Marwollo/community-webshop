<?php
    use App\Models\Product;

    $id = $_GET["id"];
    if (!isset($_GET["id"])) {
        header("location:/");
        exit();
    }

    $product = Product::getByID($id);
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    $_SESSION["cart"][$id] = array(
        "quantity" => ($_SESSION["cart"][$id] != null)? $_SESSION["cart"][$id]["quantity"] + 1 : 1,
        "name" => $product->getName(),
        "price" => $product->getPrice()
    );
    header("location:/");
?>