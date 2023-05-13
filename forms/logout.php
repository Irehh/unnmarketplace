<?php 
        session_start();
        unset($_SESSION["authenticated"]);
        unset($_SESSION["auth_user"]["username"]);
        session_destroy();
        $_SESSION["You log out successfully!"];

        header("location:../forms/index.php");
?>