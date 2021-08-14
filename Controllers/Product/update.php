<?php
    use App\Models\Product;
    use App\Models\User;
    use App\Utils\Language;

    if (!isset($_SESSION["id"]) || !isset($_GET["id"])) {
        header("location:/");
        exit();
    }
   
    try {
        $product = Product::getByID($_GET["id"]);

        if ($product->getUploaderID() == $_SESSION["id"] || User::getStatusForID($_SESSION["id"] == 1)) {
            $product->setName($_POST["name"]);
            $product->setDescription($_POST["description"]);
            $product->setPrice($_POST["price"]);
            if (isset($_FILE["thumbnail"]))
                $product->setThumbnail();
        }
        
        header("location:/");
    } catch (Exception $e) {
        header("location:/editproduct?message=" . $e->getMessage());
    }
    header("location:/");
?>