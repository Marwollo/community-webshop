<?php
    use App\Models\Product;
    use App\Utils\Language;

    if (!isset($_SESSION["id"])) {
        header("location:/");
        exit();
    }
   
    try {
        $product = Product::createProduct($_POST["name"], $_POST["description"], $_POST["price"], $_SESSION["id"]);
        $product->setThumbnail();
    } catch (Exception $e) {
        header("location:/addproduct?message=" . $e->getMessage());
    }
    header("location:/");
?>