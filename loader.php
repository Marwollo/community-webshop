<?php
    require_once("Utils/Database.php");
    require_once("Utils/Language.php");
    require_once("Utils/Route.php");
    require_once("Utils/Logger.php");
    require_once("Models/User.php");
    require_once("Models/Product.php");
    require_once("Config/Config.php");

    use App\Models\User;
    use App\Models\Product;

    User::setupDatabase();
    Product::setupDatabase();
?> 