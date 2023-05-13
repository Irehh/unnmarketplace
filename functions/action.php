<?php

include_once "../config.php";
include_once "../functions/functions.php";



switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
            $name = safe($_POST['name']);
            $email = safe($_POST['email']);
            $password = safe($_POST['password']);
            $number = safe($_POST['number']);
            $verifytoken = md5(rand());
            $confirmpassword = safe($_POST['confirmpassword']);
            $date = safe($_POST["date"]);
        registerUser($name,$email,$password,$number,$confirmpassword,$verifytoken,$date);
        break;
}