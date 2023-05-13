<?php
session_start();
include_once "../config.php";

$token = $_GET["token"];

    $conn = db();
     if(!isset($token)){
        $_SESSION["message"] = "Not Allowed!";
        header("location:../forms/login.php");
        exit(0);
    }else
    {
        $token = safe_string_url($token);
        $query = "SELECT verifytoken,status FROM users WHERE verifytoken='$token' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            if($row["status"] === "0")
            {
                $update = "UPDATE users SET status='1' WHERE verifytoken= '$token'";
                $result1 = mysqli_query($conn, $update);
                if($result1)
                {
                    $_SESSION["message"] = "Your account has been verified successfully! please login.";
                    mysqli_close($conn);
                    header("location:../forms/login.php");
                    exit(0);
                }else
                {
                    $_SESSION["message"] = "Account verification failed";
                    header("location:../forms/register.php");
                    exit(0);
                }
            }
            if($row["status"] === "1")
            {
                $_SESSION["message"] = "Email already verified! please login.";
                mysqli_close($conn);
                header("location:../forms/login.php");
                exit();
    
            }
    
        }else
        {
            $_SESSION["message"] = "This token doesn't exist!";
            mysqli_close($conn);
        header("location:../forms/login.php");
    
        }
    }