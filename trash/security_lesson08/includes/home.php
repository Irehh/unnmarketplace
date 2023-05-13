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

	</style>
	<center><h1>Home</h1></center>
	<center><a href="index.php">Home</a> . <a href="index.php">Profile</a> . <a href="posts.php">Posts</a> . <a href="signup.php">Signup</a> . <a href="login.php">Login</a></center>

	<div class="container" style="">
		
		<center><h1 style="color:#f0f;">Featured Posts</h1></center>
		<?php

			//connect to database
			if(!$con = mysqli_connect("localhost","root","","security_db"))
			{
				die("could not connect to the database");
			}

			//get posts
			$query = "select * from posts order by id desc limit 2";
			$result = mysqli_query($con,$query);

			if($result && mysqli_num_rows($result) > 0)
			{
				while ($row = mysqli_fetch_assoc($result)) {
					// code...

					//display posts
					echo "

						<div class='post'>
							<div>
								<h2>$row[title]</h2>
							</div>
							<p class='text'>".substr($row['post'],0,200)."</p>
							<a href='posts.php'>..read more..</a>
							<p class='timestamp'>". date("jS M, Y",strtotime($row['date']))."</p>
							<br style='clear: both;'>
						</div>
					";
				}
			}

		?>

	</div>
</body>
</html>