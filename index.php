<?php
    session_start();

    require_once("loader.php");
    
    use App\Utils\Route;

    /* GET */

    Route::get("/", function () {
        require("Pages/homepage.php");
    });

    Route::get("/homepage", function () {
        require("Pages/homepage.php");
    });

    Route::get("/login", function () {
        require("Pages/login.php");
    });

    Route::get("/register", function () {
        require("Pages/register.php");
    });

    Route::get("/addproduct", function () {
        require("Pages/addproduct.php");
    });

    Route::get("/logout", function () {
        require("Pages/logout.php");
    });

    Route::get("/contact", function () {
        require("Pages/contact.php");
    });

    Route::get("/cart/add", function () {
        require("Controllers/Cart/add_to_cart.php");
    });

    Route::get("/cart/remove", function () {
        require("Controllers/Cart/delete_from_cart.php");
    });

    Route::get("/delproduct", function () {
        require("Controllers/Product/delete.php");
    });

    Route::get("/editproduct", function () {
        require("Pages/editproduct.php");
    });

    /* POST */

    Route::post("/login", function () {
        require("Controllers/Auth/login.php");
    });

    Route::post("/contact", function () {
        require("Controllers/Messages/send.php");
    });

    Route::post("/register", function () {
        require("Controllers/Auth/register.php");
    });

    Route::post("/create", function () {
        require("Controllers/Product/create.php");
    });

    Route::post("/edit", function () {
        require("Controllers/Product/update.php");
    });

    Route::post("/cart/finish", function () {
        require("Controllers/Cart/finish_order.php");
    });

    Route::run("/");
?> 