<footer>
    
   <br />
<?php
    if (!isset($_SESSION["id"]))
        echo "<span class=\"sesija-info\">Trenutno niste ulogovani.</span><img src=\"https://img.icons8.com/ios/60/000000/external-shopping-cart-sales-vitaliy-gorbachev-lineal-color-vitaly-gorbachev.png\"/>";
    else
        echo "<span class=\"sesija-info\">Ulogovani ste kao " . $user->getFullName() . " </span>";
?>
    
    <p>Furni-Future © <?php echo date("Y"); ?></p>
</footer>