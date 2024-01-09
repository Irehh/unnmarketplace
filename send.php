<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

    function sendmail_verify($email,$verifytoken)
    {
//  $sql = "SELECT verifytoken FROM `users` WHERE verifytoken=$verifytoken";
//       $result = mysqli_query($conn, $sql);
//       $row =  mysqli_fetch_all($result);
//       $verifytoken = $row['verifytoken'];
         $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'unnmarketplace@gmail.com';  
        $mail->Password   = 'hvpdwjxaonndjokx';
        $mail->SMTPSecure = 'tls';  
        $mail->Port  = 587;            
    
        $mail->setFrom('unnmarketplace@gmail.com', 'UNN Marketplace');
        $mail->addAddress($email); 
     

        $mail->isHTML(true); 
        $mail->Subject = 'Email verification from UNNMarketplace';
        $email_template = "<h3>You have registered with unnmarketplace</h3>
        <h5>Verify your email address to login with the below link and start selling.</h5><br>
        <a href='http://localhost/unnmarketplace/forms/Verify_account.php?token=$verifytoken'>Click me</a>";
        $mail->Body = $email_template;
        // $email_template = "<h3>You have registered with unnmarketplace</h3>
        // <h5>Verify your email address to login with the below link and start selling.</h5><br>
        // <h5>Please copy this link and paste in browser.</h5><br>
        // <p>unnmarketplace.live/forms/Verify_account.php?token=$verifytoken</p>";
        // $mail->Body = $email_template;

        if(!($mail->send()))
        {
            return false;
        }else
        {
            return true;
        }
    }

        //for email resending verification

    function resend_email_verification($email, $verifytoken)
    {
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'unnmarketplace@gmail.com';  
        $mail->Password   = 'hvpdwjxaonndjokx';
        $mail->SMTPSecure = 'tls';  
        $mail->Port  = 587;            
    
        $mail->setFrom('unnmarketplace@gmail.com', 'UNN Marketplace');
        $mail->addAddress($email); 
     

        $mail->isHTML(true); 
        $mail->Subject = 'Resend - Email verification from UNNMarketplace';
        $email_template = "<h3>You have registered with unnmarketplace</h3>
        <h5>You Requested for your account verification code. Verify your email address to login with the below link</h5>
        <a href='http://localhost/unnmarketplace/forms/verify_account.php?token=$verifytoken'>Click me</a>";
        $mail->Body = $email_template;

        if(!($mail->send()))
        {
            return false;
        }else
        {
            return true;
        }
    }
     //as the name implies
   function send_password_reset($email,$verifytoken)
   {
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'unnmarketplace@gmail.com';  
        $mail->Password   = 'hvpdwjxaonndjokx';
        $mail->SMTPSecure = 'tls';  
        $mail->Port  = 587;            
    
        $mail->setFrom('unnmarketplace@gmail.com', 'UNNMarketplace');
        $mail->addAddress($email); 
     

        $mail->isHTML(true); 
        $mail->Subject = 'Reset Password Notification from UNN Marketplace';
        $email_template = "<h3>Email verification</h3>
        <h5>You Requested to reset yourpassword. Verify your email address to login with the below link</h5>
        <a href='http://localhost/unnmarketplace/php/action.php?reset_token=$verifytoken'>Click me</a>";
        $mail->Body = $email_template;

        if(!($mail->send()))
        {
            return false;
        }else
        {
            return true;
        }

   }
