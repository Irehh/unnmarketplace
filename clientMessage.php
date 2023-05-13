<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

function customer_message($clientemail,$clientname, $email,$clientmessage)
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
       $mail->Subject = "$clientname sent a message";
       $email_template = "
       <h5>$clientname with $clientemail said --- ". $clientmessage ." </h5><br>";
       $mail->Body = $email_template;

       if($mail->send()){
        return true;
       }else{
        return false;
       }
   }

   $email = safe($row['email']);
if(isset($_POST["client"])){
    $clientemail = safe($_POST['clientemail']);
    $clientname = safe($_POST['clientname']);
    $clientmessage = safe($_POST['message']);


    if (!filter_var($clientemail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["message"] = "Please enter a valid email address";
        header("location:vendor_information.php?user_id=$user_id");
        exit();
      }
       //prepare insert statement
    $stmt = mysqli_prepare($conn, "INSERT INTO clientMessage (name, email,message, date)
    VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssss", $clientname, $clientemail, $clientmessage, $date);
    mysqli_stmt_execute($stmt);
    if(!customer_message($clientemail,$clientname, $email, $clientmessage)){
        $_SESSION["message"] = "Unable to send message at this time";
            header("location:./vendor_information.php?user_id=$user_id");
            exit();
    }else{
        $_SESSION["message"] = "Message sent successfully";
            header("location:./vendor_information.php?user_id=$user_id");
            exit();
    }

}
