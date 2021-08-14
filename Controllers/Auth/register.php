<?php
    use App\Models\User;
    use App\Utils\Language;

    if (isset($_SESSION["id"])) {
        header("location:/index.php");
        exit();
    }

    if (isset($_POST["first_name"]))
        $first_name = $_POST["first_name"];
    if (isset($_POST["last_name"]))
        $last_name = $_POST["last_name"];
    if (isset($_POST["email"]))
        $email = $_POST["email"];
    if (isset($_POST["password"]))
        $password = $_POST["password"];
    
    try {
        $user = User::createUser($first_name, $last_name, $email, $password);
        header("location:/login?message=" . Language::getField("accountCreated"));
    } catch (Exception $e) {
        header("location:/register?message=" . $e->getMessage());
    }
?>    
