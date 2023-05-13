<?php
require "config.php";
$conn = db();
session_start();


if(isset($_SESSION["email"])){

}elseif($_SESSION["usertype"] = "seller"){
  header("location:index.php");
}elseif(!isset($_SESSION['email'])){
  header("location:index.php");
}else{
  header("location:index.php");
}


$id  = $_GET['id'];
include "pathunlink.php";

if(isset($_GET['id'])) {

    $id = safe($_GET['id']);
    $sql = "DELETE FROM product WHERE `product`.`id` = $id";

    $result = mysqli_query($conn , $sql);
    

    if($result){
        
        header("location:admin.php");
    }
    

}
?>