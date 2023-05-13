<?php

$Error = "";

if(count($_POST) > 0)
{

	$user = new User();
	$Error = $user->login($_POST);
	
	if($Error == ""){
		header("Location: index.php");
		die;
	}
 	 

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>

	<style type="text/css">
		*{
			font-family: tahoma;
			font-size: 14px;
		}

		.container{
			padding: 10px;
			box-shadow: 0px 0px 10px #aaa;
			margin: auto;
			margin-top: 20px;
			width: 100%;
			max-width: 800px;
			min-height: 100px;

		}

		.post{
			border-bottom: solid thin #ccc;
		}
		.text{
			padding:4px;
			background-color:#eee;
		}
		.timestamp{
			font-size: 12px; 
			color: #aaa;
			float: right;
		}

		form{
			width: 300px;
			padding: 10px;
			box-shadow: 0px 0px 10px #aaa;
			margin: auto;
			margin-top: 20px;
			border-radius: 10px;
		}

		form input{
			width: 270px;
			padding: 10px;
			border: solid thin #aaa;
			border-radius: 10px;
			margin: 5px;
			outline: none;
		}

		.btn{

			width: 290px;
			cursor: pointer;
		}

		.text{
			border: solid thin #aaa;
			border-radius: 10px;
			border: solid thin #aaa;
			width: 292px;
			margin-left: 5px;
			padding: 10px;
		}

	</style>
	<center><h1>Login</h1></center>

	<?php include('header.php')?>

	<div class="container" style="">
		
		<center><h1 style="color:#f0f;">Login</h1></center>
		
		<form method="post">
			
			<?php 

				if($Error != "")
				{
					echo $Error;
				}
			?>
			<br>
 			<input type="email" name="email" placeholder="Email"><br>
			<input type="password" name="password" placeholder="password"><br>
 			<br>
			<input class="btn" type="submit" value="Login">
		</form>
	</div>
</body>
</html>