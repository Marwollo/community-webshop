<?php
    use App\Models\Product;
    use App\Utils\Language;
?>
<html>
    <head>
        <title>Furnifuture | Prodavnica nameštaja</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="Furnifuture je pravo rešenje za vas ako vam treba nameštaj. Posetite naš sajt danas i kupite odličan nameštaj za sebe." />    
        <link rel="stylesheet" href="/Styles/product.css" />
        <link rel="stylesheet" href="/Styles/other.css" />
        <link rel="stylesheet" href="/Styles/login.css" />
        <link rel="stylesheet" href="/Styles/sidebar.css" />
        <link rel="shortcut icon" type="image/jpg" href="https://img.icons8.com/color/256/000000/furniture.png"/>
        <script src="https://kit.fontawesome.com/8f6713c836.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/components/header.php");
        ?>
        <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/components/navigation.php");
        ?>
        <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/components/sidebar.php");
        ?>
        <!-- Komponenta za nameštaje -->
        <span class="cart-title"><?php echo Language::getField("latestOffers"); ?></span>
        <div style="text-align: center;">
            <?php
                include($_SERVER["DOCUMENT_ROOT"] . "/components/searchbar.php");
            ?>
        </div>
        <div class="product-list">
            <?php
                $search_query = "";
                if (isset($_GET["search"]))
                    $search_query = $_GET["search"];
                $products = Product::getAll($search_query);

                foreach ($products as $product) {
                    echo $product->view();
                }
            ?>
        </div>
        <span class="cart-title"><?php echo Language::getField("myCart"); ?></span>
        <span class="cart-subtitle">
            <?php 
                $quantity = 0;
                $price = 0;
                if (isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $id => $product) {
                        $quantity += $product["quantity"];
                        $price += $product["price"] * $product["quantity"];     
                    }
                }
                echo Language::getField("quantity") . " " . $quantity . " (" . $price . " RSD)"; 
            ?>
        </span>
        <div class="order-form">  
            <?php
                if (isset($_GET["message"])) {
                    echo $_GET["message"];
                }
            ?> 
            <?php
                if (!isset($_SESSION["id"])) {
                    echo "<span class=\"cart-subtitle\">" . Language::getField("loginToOrder") . "</span>";
                }
                else if ($quantity > 0) {
                    include($_SERVER["DOCUMENT_ROOT"] . "/components/orderform.php");
                }
            ?>
        </div>
        <div class="cart-list">
            <?php
                if (isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $id => $product) {
                        echo Product::getByID($id)->view("cart");
                    }
                }
            ?>
        </div>
        <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/components/footer.php");
        ?>
    </body>
   
</html>