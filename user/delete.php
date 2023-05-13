<?php
session_start();
require_once "../config.php";
$conn = db();

if(!isset($_SESSION["authenticated"]))
{
    $_SESSION["message"] = "Please login to access user dashboard";
    header("location:../forms/login.php");
    exit(0);
}

$user_id = $_SESSION['auth_user']['user_id'];



$id  = $_GET['id'];
include "pathunlink.php";

if(isset($_GET['id'])) {

    $id = safe($_GET['id']);
    $sql = "DELETE FROM product WHERE user_id=$user_id and id=$id limit 1";
    $sql2 = "DELETE FROM comments WHERE post_id=$id limit 1";
    

   
    $result = mysqli_query($conn , $sql);
    $result2 = mysqli_query($conn , $sql2);
    

    if($result){
        
        header("location:dashboard.php");
    }
    

}
?>