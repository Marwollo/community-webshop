<?php
    use App\Models\Product;
    use App\Models\User;

    if (!isset($_GET["id"])) {
        header("location:/");
        exit();
    }
    $product = Product::getByID($_GET["id"]);
    if ($product == null) {
        header("location:/");
        exit();
    }

    if ($product->getUploaderID() == $_SESSION["id"] || User::getStatusForID($_SESSION["id"] == 1)) {
        unset($_SESSION["cart"][$_GET["id"]]);
        Product::deleteById($_GET["id"]);
    }
    header("location:/");
?>