<?php
    use App\Utils\Language;
?>
<form class="search-form" method="GET" action="/">
    <div style="display: flex; align-self: center;">
        <input type="text" placeholder="<?php echo Language::getField("enterSearch") ?>" name="search">
        &nbsp;
        <button type="submit"><ion-icon name="search"></ion-icon></button>
    </div>
    
</form> 