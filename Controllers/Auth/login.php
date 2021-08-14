<?php  
    use App\Models\User;
    use App\Utils\Language;

    if (isset($_SESSION["id"])) {
        header("location:/index.php");
        exit();
    }

    if (isset($_POST["email"]))
        $email = $_POST["email"];
    if (isset($_POST["password"]))
        $password = $_POST["password"];
    
    try {
        $user = User::verifyAccount($email, $password);
        $_SESSION["id"] = $user->getID();
        
        header("location:/");
    } catch (Exception $e) {
        header("location:/login?message=" . $e->getMessage());
    }
?>    
