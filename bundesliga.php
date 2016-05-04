<!DOCTYPE html>
<head>
<style type="text/css">
	body{
		background-image: url("bundesligaimage.png");
		background-repeat: no-repeat;
		background-size: cover;
	}
	#heading{
		color: white;
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: white;}
	#player{
		color : white;
	}
	a:link{
		text-decoration: none;
	}
	}
</style>
</head>
<title>Bundesliga</title>
<body>
<h2 id="heading">Teams</h4>
<?php
include 'connection.php';
$id = (int) $_GET['id'];
$epl = oci_parse($conn,"select distinct homeclub from played_c, game where lid = :nm and game.gid = played_c.gid and game.season = 1 order by homeclub");

oci_bind_by_name($epl, ':nm', $id);

oci_execute($epl);
while (($row = oci_fetch_array($epl, OCI_BOTH)) != false) {
  $x = urlencode($row[0]);
	// echo gettype($x);
	echo "<span><a id=player href=player.php?club=$x>$row[0]</a></span><br>";
}
oci_free_statement($epl);
oci_close($conn);
?>
<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>