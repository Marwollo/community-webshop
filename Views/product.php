<?php
    use App\Utils\Language;
    use App\Models\User;
?>
<a class="product-anchor" >
    <div class="product-object">
        <img class="product-thumbnail" src="/Uploads/thumbnail-<?php echo $this->id ?>.jpg" />
        <div class="product-container"> 
            <span class="product-name"><?php echo $this->name ?></span><br />
            <span class="product-price"><?php echo $this->price ?> RSD</span>
        
            <hr />
            <span class="product-uploader"><?php echo Language::getField("postedBy") . " " . User::getByID($this->uploader_id)->getFullName() ?></span>
            <br />
            <span class="product-hint"><?php echo $this->description ?></span>
            <div class="product-options">
                    <img style="display: <?php if(isset($_SESSION["id"])) { echo ($_SESSION["id"] == $this->uploader_id || User::getStatusForID($_SESSION["id"]))? "" : "none"; } else echo "none"; ?>" onclick="window.location.href = '/delproduct?id=<?php echo $this->id ?>'; " class="option-icon" src="https://img.icons8.com/fluency/512/000000/full-recycle-bin.png" />
                    <img onclick="window.location.href = '/cart/add?id=<?php echo $this->id ?>'; " class="option-icon" src="https://img.icons8.com/fluency/512/000000/add-shopping-cart.png" />
                    <img style="display: <?php if(isset($_SESSION["id"])) { echo ($_SESSION["id"] == $this->uploader_id || User::getStatusForID($_SESSION["id"]))? "" : "none"; } else echo "none"; ?>" onclick="window.location.href = '/editproduct?id=<?php echo $this->id ?>'; " class="option-icon" src="https://img.icons8.com/fluency/512/000000/pencil.png" />
            </div>
        </div>
    </div>
</a>