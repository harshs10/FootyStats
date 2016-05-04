<!DOCTYPE html>
<html>
<head>
	<title>Team form</title>
	<style type="text/css">
		#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: white;
	}
	body{
		background-image: url('teamform.jpg');
		background-size: cover;
	}
	a:link{
		text-decoration: none;
	}
	h5{
		color: white;
	}
	h2{
		color: white;
	}
	</style>
</head>
<body>
<form action="" method="post">
	<h2>Team Form</h2><br>
	<input type=text name="streak" placeholder="club name"></input><br>
	<br>
	<input type="submit"></input>
	<br>
</form>
<br>
<table class="sortable" border=1 cellpadding=5><tr><td><h5>Homeclub</h5></td><td><h5>Awayclub</h5></td><td><h5>Result</h5></td></tr>
<?php
include 'connection.php';
if($_POST)
{
$team = $_POST['streak'];

$sql = 'select homeclub,awayclub,result
from (select *
from (select homeclub,awayclub,gameweek,result
from game,PLAYED_C
where game.gid = PLAYED_C.GID and season = 1 and homeclub = :nm
UNION
select homeclub,awayclub,gameweek,result
from game,PLAYED_C
where game.gid = PLAYED_C.GID and season = 1 and awayclub = :nm)
order by gameweek desc)
where rownum<=6';

$stid = oci_parse($conn,$sql);

oci_bind_by_name($stid, ':nm', $team);


oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
?>
  <tr>
	<td><?php echo "<h5>$row[0]</h5>" ?></td>
	<td><?php echo "<h5>$row[1]</h5>" ?></td>
	<td><?php echo "<h5>$row[2]</h5>" ?></td>
  </tr>
<?php
}
oci_free_statement($stid);
oci_close($conn);}
?>
<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>