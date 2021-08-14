
<?php
    use App\Models\User;

    if (isset($_SESSION["id"]))
        $user = User::getByID($_SESSION["id"]);  
?>
<link rel="stylesheet" href="/Styles/navigation.css" />
<div class="navigacija">
    <a href="/" class="navigacija-anchor">
        <div class="navigacija-dugme">
            <span class="navigacija-tekst">
                Proizvodi
            </span>
        </div>
    </a>
    <a href="/contact" class="navigacija-anchor">
        <div class="navigacija-dugme">
            <span class="navigacija-tekst">
                Kontakt
            </span>
        </div>
    </a>
    <?php
        if (isset($_SESSION["id"]))
        echo "<a href=\"/addproduct\" class=\"navigacija-anchor\">
        <div class=\"navigacija-dugme\">
            <span class=\"navigacija-tekst\">
                Dodajte proizvod
            </span>
        </div>
    </a>";
        else echo "<a href=\"/login\" class=\"navigacija-anchor\">
            <div class=\"navigacija-dugme\">
                <span class=\"navigacija-tekst\">
                    Ulogujte se
                </span>
            </div>
        </a>";
    ?>
    <?php
        if (isset($_SESSION["id"]))
        echo "<a href=\"/logout\" class=\"navigacija-anchor\">
        <div class=\"navigacija-dugme\">
            <span class=\"navigacija-tekst\">
                Izlogujte se
            </span>
        </div>
    </a>";
        else echo "<a href=\"/register\" class=\"navigacija-anchor\">
            <div class=\"navigacija-dugme\">
                <span class=\"navigacija-tekst\">
                    Registrujte se
                </span>
            </div>
        </a>";
    ?>
    
</div>
<?php
    if (!isset($_SESSION["id"]))
        echo "<span class=\"sesija-info\">Trenutno niste ulogovani.</span><img src=\"https://img.icons8.com/ios/60/000000/external-shopping-cart-sales-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png\"/>";
    else
        echo "<span class=\"sesija-info\">Ulogovani ste kao " . $user->getFullName() . " </span>";
?>

