<?php 

echo "still on the index page";

$page = isset($_GET['page']) ? $_GET['page'] : "home";

$folder = "includes/";
$files = glob($folder . "*.php");
$file_name = $folder . $page . ".php";

if(in_array($file_name, $files))
{
	include($file_name);
}else{
	include "includes/404.php";
}
