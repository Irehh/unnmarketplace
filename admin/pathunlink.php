<?php

$select = "SELECT *FROM product WHERE `product`.`id`=$id LIMIT 1";
$result = mysqli_query($conn,$select);
if($result){
    $row = mysqli_fetch_assoc($result);
$path = "images/" . safe($row['image']);
unlink($path);

}

?>