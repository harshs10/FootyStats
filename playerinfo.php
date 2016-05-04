<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		background-image: url("playerinfoimage.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: navy;
	}
</style>
	<title>Player Stats</title>
</head>
<body>
<?php
include 'connection.php';
$name = urldecode($_GET['player']);
echo "<h2>$name</h2>";
echo "<table border=1 cellpadding=5><tr><td>Position</td><td>Nationality</td><td>Goals</td><td>Age</td><td>Rating</td><td>Pace</td><td>Shooting</td><td>Passing</td><td>Dribbling</td><td>Defending</td><td>Physical</td><td>Heading</td><td>Stamina</td><td>Strength</td><td>Aggression</td><td>Interceptions</td></tr>";

$playerinfo = oci_parse($conn,'SELECT player.name, outfield_player.position, player.ntnl_team,player.goals,player.age,outfield_player.rating,outfield_player.pace,outfield_player.shooting,outfield_player.passing,outfield_player.dribbling,outfield_player.defending,outfield_player.physical,outfield_player.heading,outfield_player.stamina,outfield_player.strength,outfield_player.agression,outfield_player.interceptions FROM player,OUTFIELD_PLAYER WHERE player.name=outfield_player.name AND player.name=:nm');
oci_bind_by_name($playerinfo, ':nm', $name);
$r = oci_execute($playerinfo);
	// if (!$r)
	// {
 //    $e = oci_error($stid);
 //    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	// }

while(($row = oci_fetch_array($playerinfo, OCI_BOTH)) != false)
{?>
	
	<tr>
	<!-- <td><?php echo $row[0] ?></td> -->
	<td><?php echo $row[1] ?></td>
	<td><?php echo $row[2] ?></td>
	<td><?php echo $row[3] ?></td>
	<td><?php echo $row[4] ?></td>
	<td><?php echo $row[5] ?></td>
	<td><?php echo $row[6] ?></td>
	<td><?php echo $row[7] ?></td>
	<td><?php echo $row[8] ?></td>
	<td><?php echo $row[9] ?></td>
	<td><?php echo $row[10] ?></td>
	<td><?php echo $row[11] ?></td>
	<td><?php echo $row[12] ?></td>
	<td><?php echo $row[13] ?></td>
	<td><?php echo $row[14] ?></td>
	<td><?php echo $row[15] ?></td>
	<td><?php echo $row[16] ?></td>
  	</tr>
<?php
}
oci_free_statement($playerinfo);
oci_close($conn);
?>
<!-- </table> -->
<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>