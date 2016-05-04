<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style type="text/css">
	body{
		background-image: url("welcomepageimage.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	h2{
		color:white;
		margin-left: 500px;
	}
	h3{
		color:white;
		margin-left: 400px;
	}
	h4{
		color: white;
	}
	a{
		color:green;
	}
	div.signuplogin{
		position: absolute;
		top: 0;
		right:0;
	}
	div.dropdown{
		position: relative;
		bottom:50;
		right:0;
		border: 3px solid;
		background-color: white;
	}
	.dropdown {
    position: relative;
    display: inline-block;
    background-color: white
	}

	.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
	}

	.dropdown:hover .dropdown-content {
    display: block;
	}
	a:link{
		text-decoration: none;
	}

	/*#description{
		background-color: white;
	}*/
</style>
</head>

<title>Welcome</title>
<body>
<!-- <body background="welcomepageimage.jpg"> -->
<h2>Welcome to FootyStats!</h2>
<div id="description"><span><h3>A one stop destination for all you football geeks.<br> Here you will find everything you need to know about <br>your favorite player,club or country. Go geekofy!</h3></span></div>
<div class="signuplogin">
	<a style="color:white" href="signup.php">Sign Up</a><br>
	<a style="color:white" href="login.php">Login</a>
</div>

<div class="dropdown">
  <span>Players</span>
  <div class="dropdown-content">
    <a href="outfield.php">Outfield players</a><br>
    <a href="goalkeeper.php">Goalkeepers</a><br>
    <a href="query.php">Search</a>
  </div>
</div>

<div class="dropdown">
	<span>Leagues</span>
	<div class="dropdown-content">
		<a href="epl.php?id=1">EPL</a><br>
		<a href="bundesliga.php?id=2">Bundesliga</a><br>
		<a href="ligue.php?id=3">Ligue 1</a><br>
		<a href="laliga.php?id=4">La Liga</a><br>
		<a href="epl.php?id=5">Championship</a><br>
		<a href="bundesliga.php?id=8">2. Bundesliga</a><br>
		<a href="ligue.php?id=6">Ligue 2</a><br>
		<a href="bundesliga.php?id=7">Segunda</a>
	</div>
</div>	

<div class="dropdown">
<span><a style="color:black" href="teamsearch.php">Team Search</a></span>
</div>

<div class="dropdown">
<span><a style="color:black" href="dreamteam.php">Dream Team</a></span>
</div>

<div class="dropdown">
<span><a style="color:black" href="teamform.php">Team Form</a></span>
</div>

<div class="dropdown">
<span><a style="color:black" href="rowcount.php">Row Count</a></span>
</div>

</body>
</html>