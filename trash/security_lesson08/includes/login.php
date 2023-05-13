<?php

session_start();

$Error = "";

if(count($_POST) > 0)
{

	//connect to database
	if(!$con = mysqli_connect("localhost","root","","security_db"))
	{
		die("could not connect to the database");
	}

	//validate
	//email
	if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
	{
		$Error = "wrong email";
	}

	//password
	if(empty($_POST['password']))
	{
		$Error = "wrong password";
	}

	
	if($Error == "")
	{
		$email	= addslashes($_POST['email']);
		$password	= addslashes($_POST['password']);
 
		//get user
		$query = "select * from users where email = '$email' && password = '$password' ";
		$result = mysqli_query($con,$query);
 
 		if($result && mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);
 				
 			$_SESSION['user_id'] = $row['id'];

 			header("Location: index.php");
 			die;
 		}

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
	<center><a href="index.php">Home</a> . <a href="index.php">Profile</a> . <a href="posts.php">Posts</a> . <a href="signup.php">Signup</a> . <a href="login.php">Login</a></center>

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