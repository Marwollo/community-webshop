<?php
    use App\Utils\Language;
    use App\Models\Product;
    if (!isset($_GET["id"])) {
        header("location:/");
        exit();
    }
    $product = Product::getByID($_GET["id"]);
?>
<html>
    <head>
        <title>Furnifuture | Izmenite proizvod</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="Furnifuture je pravo rešenje za vas ako vam treba nameštaj. Posetite naš sajt danas i kupite odličan nameštaj za sebe." />    
        <link rel="stylesheet" href="/Styles/login.css" />
        <link rel="stylesheet" href="/Styles/other.css" />
    </head>
    <body>
        <!-- Header komponenta -->
        <?php
            require($_SERVER["DOCUMENT_ROOT"] . "/Components/header.php");
        ?>
        <!-- Navigaciona komponenta -->
        <?php
            require($_SERVER["DOCUMENT_ROOT"] . "/Components/navigation.php");
        ?>
        
        <div class="login-canvas">
            
            <div class="login-box">
                <form enctype="multipart/form-data" class="login-form" method="POST" action="/edit?id=<?php echo $_GET["id"]; ?>">
                    <label for="name"><b><?php echo Language::getField("nameProduct"); ?></b></label>
                    <input value="<?php echo $product->getName() ?>" type="text" placeholder="<?php echo Language::getField("enterNameProduct"); ?>" name="name" required>

                    <label for="description"><b><?php echo Language::getField("descriptionProduct"); ?></b></label>
                    <input value="<?php echo $product->getDescription() ?>" type="text" placeholder="<?php echo Language::getField("enterDescriptionProduct"); ?>" name="description" required>

                    <label for="thumbnail"><b><?php echo Language::getField("thumbnailProduct"); ?></b></label>
                    <input type="file" name="thumbnail">

                    <label for="price"><b><?php echo Language::getField("priceProduct"); ?></b></label>
                    <input value="<?php echo $product->getPrice() ?>" min="0" step=".01" type="number" placeholder="<?php echo Language::getField("enterPriceProduct"); ?>" name="price" required>
                    <?php
                        if (isset($_GET["message"])) {
                            echo $_GET["message"];
                        }
                    ?>
                    <button type="submit"><?php echo Language::getField("submitProduct"); ?></button>
                </form>
            </div>
        </div>
        
    </body>
</html>