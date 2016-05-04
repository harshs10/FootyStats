<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style type="text/css">
	body{
		background-repeat: no-repeat;
		background-size: cover;
		background-image: url("signupimage2.jpg");
	}
	div.home{
		position: absolute;
		top: 0;
		right: 0;
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: white;
	}
	a{
		color: white;
	}
	</style>
</head>
<title>Sign Up</title>
<body>

<form action="credsignup.php>" method="post">
	<input type="text" value placeholder="Email"name="email"><br>
	<input type="text" value placeholder="Username" name="username"><br>
	<input type="password" value placeholder="Password" name="password"><br>
  	<input type="text" value placeholder="First name" name="firstname"><br>
  	<input type="text" value placeholder="Last name" name="lastname"><br>
  	<input type="submit" value="Sign Up">
</form>


<p>Already a member?<a href="login.php">Login</a></p>

<div class = "home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>

</body>
</html>