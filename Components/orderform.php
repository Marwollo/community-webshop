<?php
    use App\Utils\Language;
?>
<form class="login-form" method="POST" action="/cart/finish">
    <label for="address"><b><?php echo Language::getField("address") ?></b></label>
    <div style="display: flex; align-self: center;">
    <input type="text" placeholder="<?php echo Language::getField("enterAddress") ?>" name="address" required>
&nbsp;
    
    <button type="submit"><?php echo Language::getField("checkout") ?></button>
</div>
</form>