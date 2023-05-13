<?php
session_start();

//include all functions
require ('../private/includes/functions.php');


$page = isset($_GET['url']) ? $_GET['url'] : "home";

//includes folder
$folder = "../private/includes/";

//get all files from folder
$files = glob($folder . "*.php");
$file_name = $folder . $page . ".php";

if(in_array($file_name, $files))
{
	include($file_name);
}else{
	include "../private/includes/404.php";
}
