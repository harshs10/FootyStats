<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style type="text/css">
	body{
		background-repeat: no-repeat;
		background-size: cover;
		background-image: url("loginimage.jpg");
	}
	h1{
		font-family: "Montserrat";
		color: white;
	}
	.Login-box input{
		width: 220px;
    	padding: 20px;
    	background: #fff;
    	border-radius: 5px;
    	border-top: 5px solid #ff656c;
    	margin: 0 auto;
	}
	button{
		width: 220px;
    	padding: 20px;
    	background: gray;
    	border-radius: 5px;
    	/*border-top: 5px solid #ff656c;*/
    	margin: 10 auto;
	}
	button:hover{
		background-color: White;
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: white;
	}
	</style>
</head>
<title>Login</title>
<body>
<div class="Login-box">
	<h1>Login</h1>
	<input type="text" value placeholder="Username" id="username"><br>
	<input type="password" value placeholder="Password" id="password"><br>
	<button>Submit</button>
</div>

<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>