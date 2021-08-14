<?php
    use App\Utils\Language;

?>
<html>
    <head>
        <title>Furnifuture | Kontaktirajte nas</title>
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
        <br />
        <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=Trg%20Kralja%20Milana%201+(Furni-future)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
        <br />
        <p style="font-family: 'Poppins'">+381 69 123 4567 - office@furnifuture.com</p>   
            <div class="login-box">
                <form class="login-form" method="POST" action="/contact">
                    <label for="first_name"><b>Vaše ime</b></label>
                    <input type="text" placeholder="Unesite vaše ime" name="first_name" required>

                    <label for="last_name"><b>Vaše prezime</b></label>
                    <input type="text" placeholder="Unesite vaše prezime" name="last_name" required>

                    <label for="mail"><b><?php echo Language::getField("yourPhoneNumber") ?></b></label>
                    <input type="tel" placeholder="<?php echo Language::getField("enterPhoneNumber") ?>" name="phone" required>

                    <label for="message"><b><?php echo Language::getField("yourMessage") ?></b></label>
                    <textarea type="text" placeholder="<?php echo Language::getField("enterMessage") ?>" name="message" required></textarea>
                    <?php
                        if (isset($_GET["message"])) {
                            echo $_GET["message"];
                        }
                    ?>
                    <button type="submit"><?php echo Language::getField("send") ?></button>
                </form>
            </div>
          
        </div>
       
    </body>
</html>