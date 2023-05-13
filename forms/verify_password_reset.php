<?php
session_start();
include "../config.php";
$conn = db();


if(isset($_GET["token"]))
{
    $token =$_GET["token"];
    $sql = "SELECT verifytoken,status FROM users WHERE verifytoken='$token' LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        $row = mysqli_fetch_array($query);
        if($row["status"] == "0")
        {
            $clicked_token = $row["verifytoken"];
            $sql_update = "UPDATE users SET status='1' WHERE verifytoken = '$clicked_token' LIMIT 1";
            $sqlquery = mysqli_query($conn, $sql_update);

            if($sqlquery)
            {
                $_SESSION["message"] = "Your account has been verified successfully! please login.";
                header("location:../forms/login.php");
                exit(0);

            }else
            {
                $_SESSION["message"] = "Account verification failed";
                header("location:../forms/register.php");
                exit(0);
            }

        }else
        {
            $_SESSION["message"] = "Email already verified! pleaase login.";
            header("location:../forms/login.php");

        }

    }else
    {
        $_SESSION["message"] = "This token doesn't exist!";
    header("location:../forms/login.php");

    }

}else
{
    $_SESSION["message"] = "Not Allowed!";
    header("location:../forms/login.php");
}


?>
