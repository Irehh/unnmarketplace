<?php

if(!isset($_SESSION["authenticated"]))
   {
       $_SESSION["message"] = "Please login to access user dashboard";
       header("location:../forms/login.php");
       exit(0);
   }

$select = "SELECT * FROM `product` WHERE user_id=$user_id OR id=$id limit 1";
$result = mysqli_query($conn,$select);
if($result){
    $row = mysqli_fetch_assoc($result);
$path = "../images/" . safe($row['image']);
unlink($path);

}

?>