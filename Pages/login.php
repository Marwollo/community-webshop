<?php
    if (isset($_SESSION["id"])) {
        header("location:$url/");
        exit();
    }
?>
<html>
    <head>
        <title>Furnifuture | Ulogujte se</title>
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
                <form class="login-form" method="POST" action="/login">
                    <label for="mail"><b>E-mail adresa</b></label>
                    <input type="text" placeholder="Unesite e-mail adresu" name="email" required>

                    <label for="password"><b>Vaša šifra</b></label>
                    <input type="password" placeholder="Unesite šifru" name="password" required>
                    <?php
                        if (isset($_GET["message"])) {
                            echo $_GET["message"];
                        }
                    ?>
                    <button type="submit">Ulogujte se</button>
                </form>
            </div>
        </div>
        
    </body>
</html>