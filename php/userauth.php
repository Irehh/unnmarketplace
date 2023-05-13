<?php

require_once "../config.php";
include_once "../send.php";
session_start();


function confirmPasswordMatch($password, $confirmPassword)
{
    if($password === $confirmPassword){
        return true;
    } else {
        return false;
    }
}

 function checkEmailExist($email)
{
    $conn = db();
            $email = safe($email);
            $query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
}

     //register users
function registerUser($name, $email, $password, $number, $confirmPassword, $verifytoken, $date)
{
  //check if all required fields are filled
  if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($number)) {
    $_SESSION["message"] = "All input fields are required";
    header("location:../forms/register.php");
    exit();
  }

  //validate email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
    $_SESSION["message"] = "Please enter a valid email address";
    header("location:../forms/register.php");
    exit();
  }

  //create database connection
  $conn = db();

  //check if email already exists
  if (checkEmailExist($email) == true) {
      $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
    $_SESSION["message"] = "Email already exist! Please login!";
    header("location:../forms/login.php");
    exit();
  }

  //check if phone number is valid
  if (!validate_phone($number)) {
      $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
    $_SESSION["message"] = "Oops!! Something is wrong, please check the number as this is how customers will reach you.";
    header("location:../forms/register.php");
    exit();
    if(!preg_match("/^([0-9]{11})$/", $number)) {
        $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
        $_SESSION["message"] = "Enter a correct phone number. This is how customers will reach you";
        header("location:../forms/register.php");
        exit();
        }
  }

  //check if passwords match
  if (!confirmPasswordMatch($password, $confirmPassword)) {
      $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
      
    $_SESSION["message"] = "Password Mismatch!";
    header("location:../forms/register.php");
    exit();
  }

  //hash password
  $password1 = password_hash($password, PASSWORD_DEFAULT);

  //set user status and type
  $status = "0";
  $userType = "vendor";
  

  //prepare insert statement
  $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, number, usertype, verifytoken, status, date)
                                VALUES (?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, "sssissis", $name, $email, $password1, $number, $userType, $verifytoken, $status, $date);

  //execute insert statement
  if (!mysqli_stmt_execute($stmt)) {
      $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
    $_SESSION["message"] = "Database error";
    header("location:../forms/register.php");
    exit();
  }else {
      
      if(!sendmail_verify($email,$verifytoken)){
          $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["name"] = $name;
            $_SESSION["number"]= $number;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
            
          $_SESSION["message"] = "Cannot send mail at this time. Please try again!";
    header("location:../forms/register.php");
    exit();
      }else{
          $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
          $_SESSION["message"] = "Account created and email verification sent successfully. Check your mail or spam folder";
    header("location:../forms/login.php");
    exit();
      }
      
    
  }
}

//login users
function loginUser($email, $password) 
{
    //create a connection variable using the db function in config.php
    $conn = db();
    if (!empty($email) && !empty($password)) {
        // Use prepared statements to prevent SQL injection attacks
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row["usertype"] === "admin") {
                if (password_verify($password, $row["password"])) {
                    $_SESSION["admin"] = $row["name"];
                    $_SESSION["admin_id"] = $row["id"];
                    header("location:../admin/admin.php");
                    exit(0);
                } else {
                    $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
                    $_SESSION["message"] = "Invalid email or password";
                    header("location:../forms/login.php");
                    exit(0);
                }
            } elseif ($row["usertype"] === "") {
                $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
                $_SESSION["message"] = "Please login properly";
                header("location:../forms/login.php");
                exit(0);
            } elseif ($row["usertype"] === "vendor") {
                if ($row["status"] == "1") {
                    if (password_verify($password, $row["password"])) {
                        $_SESSION['auth_user'] = [
                            "user_id" => $row["id"]
                        ];
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["message"] = "You are logged in.";
                        header("location:../user/dashboard.php");
                        exit(0);
                    } else {
                        $_SESSION["email"] = $email;
                        $_SESSION["password"]= $password;
                        $_SESSION["message"] = "Invalid email or password";
                        header("location:../forms/login.php");
                        exit(0);
                    }
                } else {
                    $_SESSION["email"] = $email;
                    $_SESSION["password"]= $password;
                    $_SESSION["message"] = "Please verify your email address";
                    header("location:../forms/resend_email_verification.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
            $_SESSION["message"] = "Invalid email or password";
            header("location:../forms/login.php");
            exit(0);
        }
    } else {
        $_SESSION["email"] = $email;
            $_SESSION["password"]= $password;
        $_SESSION["message"] = "All fields are mandatory";
        header("location:../forms/login.php");
        exit(0);
    }
    //close connection
    mysqli_close($conn);
}


// from post(resend) and require resend_email_verification function from send.php
function resend_email($email)
{
    $conn = db();
    if(!empty($email))
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["email"] = $email;
            $_SESSION["message"] = "Please enter a valid email address";
            header("location:../forms/register.php");
            exit();
          }else
          {
            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            if($row["status"] === "0")
            {   
                $verifytoken = $row["verifytoken"];
                if(!resend_email_verification($email, $verifytoken))
                {
                    $_SESSION["email"] = $email;
                    $_SESSION["message"] = "Oops! Email cannot be sent at the moment!"; 
                    header("location:../forms/resend_email_verification.php");
                    exit(0);
                }else{
                    $_SESSION["email"] = $email;
                    $_SESSION["message"] = "Email sent successfully!";
                header("location:../forms/login.php");
                exit(0);

                }
                
            }
            else
            {
                $_SESSION["email"] = $email;
                $_SESSION["message"] = "Oops! Email is already verified!"; 
                header("location:../forms/login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION["email"] = $email;
            $_SESSION["message"] = "Oops! Email is not registered, please register now!"; 
            header("location:../forms/register.php");
            exit(0);
        }

          }
        
    }
    else
    {
        $_SESSION["message"] = "Oops! Please enter your email in the email field!"; 
        header("location:../forms/resend_email_verification.php");
        exit(0);
    }
}


// from post(reset) and require send_password_reset function from send.php
function resetPassword($email,$verifytoken)
{
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["email"] = $email;
        $_SESSION["message"] = "Please enter a valid email address";
        header("location:../index.php");
        exit();
      }else
      {
        //create a connection variable using the db function in config.php
    $conn = db();
    
   //open connection to the database and check if username exist in the database using prepared statement
    $sql = "SELECT email FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $email);

  if(mysqli_stmt_num_rows($stmt) > 0)
  {
    //using prepared statement to update verifytoken
    $update = "UPDATE `users` SET verifytoken=? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "ss", $verifytoken, $email);
    mysqli_stmt_execute($stmt);
    
    if(mysqli_stmt_affected_rows($stmt) > 0)
    {
        if(send_password_reset($email,$verifytoken)){
        $_SESSION["message"] = "We have e-mailed you your reset link";
        header("location:../forms/resetpassword.php");
        exit(0);
    }else
    {
        $_SESSION["email"] = $email;
        $_SESSION["message"] = "Something went wrong! Please try again";
        header("location:../forms/resetpassword.php");
        exit(0);

    }
        
    }else
    {
        $_SESSION["email"] = $email;
        $_SESSION["message"] = "Something went wrong";
        header("location:../forms/resetpassword.php");
        exit(0);
    }
  }
  else
  {
      $_SESSION["email"] = $email;
       $_SESSION["message"] = "User doesn't exist";
        header("location:../forms/resetpassword.php");
        exit(0);
  }
  }

}

// from get(token)
// function verify_account_token($token)
// {
//     $conn = db();
//      if(!isset($_GET["token"])){
//         $_SESSION["message"] = "Not Allowed!";
//         header("location:../forms/login.php");
//     }else
//     {
//         $sql = "SELECT verifytoken,status FROM users WHERE verifytoken=? LIMIT 1";
//         // Prepare the statement
//         $stmt1 = mysqli_prepare($conn, $sql);
//         // Bind the parameters
//         mysqli_stmt_bind_param($stmt1, "s", $token);
//         // Execute the statement
//         mysqli_stmt_execute($stmt1);
//         // Get the result
//     $result = mysqli_stmt_get_result($stmt1);
    
//         if(mysqli_num_rows($result) > 0)
//         {
//             $row = mysqli_fetch_assoc($result);
//             if($row["status"] === "0")
//             {
//                 // $clicked_token = $row["verifytoken"];
//                 $status_update = 1;
//                 $sql_update = "UPDATE users SET status=? WHERE verifytoken = ? LIMIT 1";
//                 $stmt = mysqli_prepare($conn, $sql_update);
//                 // Bind the parameters
//                 mysqli_stmt_bind_param($stmt, "is", $status_update,$token);
//                 // Execute the statement
//                 mysqli_stmt_execute($stmt);
//                 // Get the result
//             $results = mysqli_stmt_get_result($stmt);
    
//                 if($results)
//                 {
                    
//                     $_SESSION["message"] = "Your account has been verified successfully! please login.";
//                     mysqli_stmt_close($stmt);
//                     mysqli_stmt_close($stmt1);
//                     header("location:../forms/login.php");
                    
//                     exit(0);
    
//                 }else
//                 {
//                     $_SESSION["message"] = "Account verification failed";
//                     mysqli_stmt_close($stmt1);
//                     mysqli_stmt_close($stmt);
//                     header("location:../forms/register.php");
//                     exit(0);
//                 }
                
//             }else
//             {
//                 $_SESSION["message"] = "Email already verified! please login.";
//                 header("location:../forms/login.php");
//                 exit();
    
//             }
    
//         }else
//         {
//             $_SESSION["message"] = "This token doesn't exist!";
//         header("location:../forms/login.php");
    
//         }
//     }
// }

function reset_redirect($reset_token) 
{
    $conn = db();
    if (isset($_GET["reset_token"])) {
    $sql = "SELECT * FROM users WHERE verifytoken=? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reset_token);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if ($row["status"] == "0") {
            $sql_update = "UPDATE users SET status='1' WHERE verifytoken=? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt, "s", $reset_token);
            mysqli_stmt_execute($stmt);
            $sqlquery = mysqli_stmt_affected_rows($stmt);
            if ($sqlquery) {
                $_SESSION["message"] = "Your account password verified successfully! please change your password.";
                $_SESSION["reset_auth"] = True;
                $id = $row["id"];
                header("location:../forms/change_password.php?user_id=$id");
                exit();
            } else {
                $_SESSION["message"] = "Account reset verification failed";
                header("location:../forms/register.php");
                exit();
            }
        } else {
            $_SESSION["message"] = "Please change your password!";
            $_SESSION["reset_auth"] = True;
            $id = $row["id"];
            header("location:../forms/change_password.php?user_id=$id");
            exit();
        }
    } else {
        $_SESSION["message"] = "This token doesn't exist!";
        header("location:../forms/login.php");
    }
    } else {
        $_SESSION["message"] = "Not Allowed!";
        header("location:../forms/login.php");
    }
}

// from get(reset_token) to change password --last step
// function reset_redirect($reset_token)
// {
//     $conn = db();
//     if(isset($_GET["reset_token"]))
//     {
//     $sql = "SELECT * FROM users WHERE verifytoken='$reset_token' LIMIT 1";
//     $query = mysqli_query($conn, $sql);

//     if(mysqli_num_rows($query) > 0)
//     {
        
//         $row = mysqli_fetch_array($query);
//         if($row["status"] == "0")
//         {
            
//             $sql_update = "UPDATE users SET status='1' WHERE verifytoken = '$reset_token' LIMIT 1";
//             $sqlquery = mysqli_query($conn, $sql_update);

//             if($sqlquery)
//             {
//                 $_SESSION["message"] = "Your account password verified successfully! please change your password.";
//                 $_SESSION["reset_auth"] = True;
//                 $id = $row["id"];
//             header("location:../forms/change_password.php?user_id=$id");
//                 exit();

//             }else
//             {
//                 $_SESSION["message"] = "Account reset verification failed";
//                 header("location:../forms/register.php");
//                 exit();
//             }

//         }else
//         {
//             $_SESSION["message"] = "Please change your password!";
//             $_SESSION["reset_auth"] = True;
//             $id = $row["id"];
//             header("location:../forms/change_password.php?user_id=$id");
//             exit();

//         }

//     }else
//     {
//         $_SESSION["message"] = "This token doesn't exist!";
//     header("location:../forms/login.php");

//     }

//     }else
//     {
//         $_SESSION["message"] = "Not Allowed!";
//         header("location:../forms/login.php");
//     }

// }

function changePassword($password, $confirmPassword, $id) 
{
    if (empty($password) && empty($confirmPassword)) {
        $_SESSION["message"] = "Enter an input";
        header("location:../forms/change_password.php?user_id=$id");
        exit();
    } else {
        // create a connection variable using the db function in config.php
        $conn = db();

        // check if the password and confirm password match
        $passwordConfirm = confirmPasswordMatch($password, $confirmPassword);

        if ($passwordConfirm == true) {
            
              //hash password
          $password = password_hash($password, PASSWORD_DEFAULT);
            // create the prepared statement
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=? LIMIT 1");

            // bind the parameters to the statement
            $stmt->bind_param("si", $password, $id);

            // execute the statement
            if ($stmt->execute()) {
                
                $_SESSION["message"] = "Password successfully changed. Please login!";
                header("location:../forms/login.php");
                exit(0);
            } else {
                $_SESSION["message"] = "Unable to update password at the moment. Try again!";
                header("location:../forms/change_password.php?user_id=$id");
                exit(0);
            }
        } else {
            $_SESSION["password"]= $password;
            $_SESSION["comfirmpassword"]= $comfirmpassword;
            $_SESSION["message"] = "Password mis-match!";
            header("location:../forms/change_password.php?user_id=$id");
            exit();
        }
    }
}



// function getusers(){
//     $conn = db();
//     $sql = "SELECT * FROM Students";
//     $result = mysqli_query($conn, $sql);
//     echo"<html>
//     <head></head>
//     <body>
//     <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
//     <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
//     <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
//     if(mysqli_num_rows($result) > 0){
//         while($data = mysqli_fetch_assoc($result)){
//             //show data
//             echo "<tr style='height: 30px'>".
//                 "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
//                 <td style='width: 150px'>" . $data['name'] .
//                 "</td> <td style='width: 150px'>" . $data['email'] .
//                 "</td> <td style='width: 150px'>" . $data['gender'] . 
//                 "</td> <td style='width: 150px'>" . $data['country'] . 
//                 "</td>
//                 <form action='action.php' method='post'>
//                 <input type='hidden' name='id'" .
//                  "value=" . $data['id'] . ">".
//                 "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
//                 "</tr>";
//         }
//         echo "</table></table></center></body></html>";
//     }
//     //return users from the database
//     //loop through the users and display them on a table
// }

function deleteAccount($id) 
{
    $conn = db();
    //delete user with the given id from the database
    $sql = "DELETE FROM `students` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        echo "User account deleted successfully";
    } else {
        echo "Unable to delete user at the moment";
    }
    mysqli_stmt_close($stmt);
}



function checkNumberExist($number) 
{
    $conn = db();
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

// sellproperty($email,$name,$number,$description,$location,$image,$dates)
// {

// }


function validate_phone($number)
{
    if(preg_match("/^([0-9]{11})$/", $number)) {
        return true;
        } else {
            $_SESSION["message"] = "Enter a correct phone number. This is how customers will reach you";
        return false;
        }
}
