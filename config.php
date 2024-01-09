<?php

//database connection
function db() 
{
    //set your configs here

    $hostname = "localhost";
    $user = "root";
    $password = "";
    $db = "unnmarketplace";

    $conn = mysqli_connect($hostname, $user, $password , $db);

    if(!$conn){
        echo "<script> alert('Error connecting to the database') </script>";
    }
    return $conn;

}

function safe($data)
{
    $conn = db();
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

function safe_string_url($data)
{
    $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    $data = urlencode($data);
    return $data;

}