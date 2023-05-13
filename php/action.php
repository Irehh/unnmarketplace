<?php

include_once "../config.php";
include_once "userauth.php";



switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
            $name = safe($_POST['name']);
            $email = safe($_POST['email']);
            $password = safe($_POST['password']);
            $number = safe($_POST['number']);
            $verifytoken = safe($_POST['verifytoken']);
            $confirmpassword = safe($_POST['confirmpassword']);
            $date = safe($_POST["date"]);
        registerUser($name,$email,$password,$number,$confirmpassword,$verifytoken,$date);
        break;

    case isset($_POST['login']):
            $email = safe($_POST['email']);
            $password = safe($_POST['password']);
        loginUser($email, $password);
        break;
        
    case isset($_POST["delete"]):
        $id = (int)($_POST['id']);
        deleteaccount($id);
        break;
    // case isset($_GET["all"]):
    //     getusers();
    //     break;
    case isset($_POST["resend"]):
        $email = safe($_POST['email']);
        resend_email($email);
            break;

    // case isset($_POST["sell_item"]):
    //     $email = safe($_POST['email']);
    //     $name = safe($_POST['name']);
    //     $number = safe($_POST['number']);
    //     $description = safe($_POST['description']);
    //     $location = safe($_POST['location']);
    //     $image = safe($_POST['image']);
    //     $date = safe($_POST['date']);
    //     sellproperty($email,$name,$number,$description,$location,$image,$dates);
    //     break;
    // case isset($_GET["token"]):
    //     $token = $_GET["token"];
    //     verify_account_token($token);
    //         break;
            //from password reset file to get email reset link
    case isset($_POST["reset"]):
        $email = safe($_POST['email']);
        $verifytoken = md5(rand());
        resetPassword($email, $verifytoken);
        break;
            //account is verified but remain to change password
    case isset($_GET["reset_token"]):
        $reset_token = safe_string_url($_GET['reset_token']);
        reset_redirect($reset_token);
            break;
            //this is for the file in forms folder to change password
    case isset($_POST["changepassword"]):
        $password = safe($_POST['password']);
        $confirmpassword = safe($_POST['confirmpassword']);
        $id = $_POST["user_id"];
        changepassword($password,$confirmpassword,$id);
            break;
}