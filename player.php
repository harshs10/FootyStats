<!DOCTYPE html>
<html>
<head>
	<title>Squad</title>
	<style type="text/css">
	body{
		background-image: url("playerimage.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: navy;
	}
	#cap{
		color: white;
	}
	#StadiumCapacity{
		color:white;
	}
	#player{
		color: white;

	}

	a:link{
		text-decoration: none;
	}
	</style>
</head>
<body>
<!-- <h1><? php echo $name ?></h1> -->
<?php
	include 'connection.php';
	$name = urldecode($_GET['club']);
	echo "<h1>$name</h1>";
	$player = oci_parse($conn,'SELECT player.name FROM player,club WHERE player.club=club.name AND club.name= :nm');
	oci_bind_by_name($player, ':nm', $name);
	$r = oci_execute($player);
	echo "<h1>Squad</h1>";
	while(($row = oci_fetch_array($player, OCI_BOTH)) != false)
	 {
		$x = $row[0];
		$y = urlencode($x);
		echo "<span><a id=player href=playerinfo.php?player=$y><h4>$x</h4></a></span>";
	}
	oci_free_statement($player);

	$stadiumcap = oci_parse($conn,'SELECT stadium.capacity, stadium.name from club,stadium WHERE stadium.sid=club.sid AND club.name= :nn');
	oci_bind_by_name($stadiumcap, ':nn', $name);
	$b = oci_execute($stadiumcap);
	echo "<h1 id='StadiumCapacity'>Stadium capacity</h1>";
	while(($row = oci_fetch_array($stadiumcap, OCI_BOTH)) != false)
	{
		echo "<h1 id='cap'>$row[0]</h1>";
		echo "<h1 id='cap'>$row[1]</h1>";
	}
	oci_free_statement($stadiumcap);
	oci_close($conn);
?>
<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>