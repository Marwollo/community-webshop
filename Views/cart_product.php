<?php
    use App\Utils\Language;
    use App\Models\User;
?>
<a class="product-anchor" href="/cart/remove?id=<?php echo $this->id ?>">
    <div class="product-object">
        <img class="product-thumbnail" src="/Uploads/thumbnail-<?php echo $this->id ?>.jpg" />
        <div class="product-container"> 
            <span class="product-name"><?php echo $this->name ?></span><br />
            <span class="product-price"><?php echo $this->price * $_SESSION["cart"][$this->id]["quantity"] ?> RSD</span>
        
            <hr />
            <span class="product-uploader"><?php echo Language::getField("quantity") . " " . $_SESSION["cart"][$this->id]["quantity"] ?></span>
            <br />
            <span class="product-hint"><?php echo Language::getField("clickToRemove") ?></span>
        </div>
    </div>
</a>