<?php



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
		$Error = "Please add a valid email";
	}

	//name
	if(empty($_POST['name']))
	{
		$Error = "Please select a valid name";
	}

	//password
	if(empty($_POST['password']))
	{
		$Error = "Please select a valid password";
	}

	

	//gender
	if(empty($_POST['gender']))
	{
		$Error = "Please select a valid gender";
	}

	
	if($Error == "")
	{
		$email	= addslashes($_POST['email']);
		$password	= addslashes($_POST['password']);
		$gender	= addslashes($_POST['gender']);
		$name	= addslashes($_POST['name']);

		//save user
		$query = "insert into users (email,password,gender,name) values ('$email','$password','$gender','$name')";
		$result = mysqli_query($con,$query);
 
 		header("Location: login.php");
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
	<center><h1>Signup</h1></center>

	<?php include('header.php')?>

	<div class="container" style="">
		
		<center><h1 style="color:#f0f;">Signup</h1></center>
		
		<form method="post">
			
			<?php 

				if($Error != "")
				{
					echo $Error;
				}
			?>
			<br>
			<input type="text" name="name" placeholder="Name"><br>
			<input type="email" name="email" placeholder="Email"><br>
			<input type="text" name="password" placeholder="password"><br>
			<select class="text" name="gender">
				<option></option>
				<option>Male</option>
				<option>Female</option>
			</select><br>
			<br>
			<input class="btn" type="submit" value="Signup">
		</form>
	</div>
</body>
</html>