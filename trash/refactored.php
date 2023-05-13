<?php

function registerUser($name, $email, $password, $number, $confirmPassword, $verifyToken, $date)
{
  //check if all required fields are filled
  if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($number)) {
    $_SESSION["message"] = "All input fields are required";
    header("location:../forms/register.php");
    exit();
  }

  //validate email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["message"] = "Please enter a valid email address";
    header("location:../forms/register.php");
    exit();
  }

  //create database connection
  $conn = db();

  //check if email already exists
  if (checkEmailExist($email) == true) {
    $_SESSION["message"] = "Email already exist! Please login!";
    header("location:../forms/login.php");
    exit();
  }

  //check if phone number is valid
  if (!validate_phone($number)) {
    $_SESSION["message"] = "Oops!! Something is wrong, please check the number as this is how customers will reach you.";
    header("location:../forms/register.php");
    exit();
  }

  //check if passwords match
  if (!confirmPasswordMatch($password, $confirmPassword)) {
    $_SESSION["message"] = "Password Mismatch!";
    header("location:../forms/register.php");
    exit();
  }

  //hash password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //set user status and type
  $status = "0";
  $userType = "vendor";

  //prepare insert statement
  $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, number, usertype, verifytoken, status, date)
                                VALUES (?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, "ssssssis", $name, $email, $password, $number, $userType, $verifyToken, $status, $date);

  //execute insert statement
  if (!mysqli_stmt_execute($stmt) || !sendmail_verify($email, $verifyToken)) {
    $_SESSION["message"] = "Database error";
    header("location:../forms/register.php");
    exit();
  }else {
    $_SESSION["message"] = "Account created and email verification sent successfully. Check your mail";
    header("location:../forms/login.php");
    exit();
  }
}
