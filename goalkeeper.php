<!DOCTYPE html>
<title>Goalkeepers</title>
<head><script src="sorttable.js"></script></head>
<style type="text/css">
	body{
		background-image: url("goalkeeperimage.jpg");
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: fixed;
	}
	td{
		color: white;
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
	table.sortable thead{
    	color:#666666;
    	font-weight: bold;
    	cursor: default;
	}
</style>
<body>
<table class="sortable" border=1 cellpadding=5><tr><td>Name</td><td>Rating</td><td>Reflexes</td><td>Kicking</td><td>Diving</td><td>Handling</td><td>Positioning</td><td>Speed</td></tr>
<?php  
	include 'connection.php';
	$stid = oci_parse($conn, 'SELECT name,rating,reflexes,kicking,diving,handling,positioning,speed FROM GOALKEEPER ORDER BY rating DESC');
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
?>
  <tr>
	<td><?php echo $row[0] ?></td>
	<td><?php echo $row[1] ?></td>
	<td><?php echo $row[2] ?></td>
	<td><?php echo $row[3] ?></td>
	<td><?php echo $row[4] ?></td>
	<td><?php echo $row[5] ?></td>
	<td><?php echo $row[6] ?></td>
	<td><?php echo $row[7] ?></td>
  </tr>
<?php
}
oci_free_statement($stid);
oci_close($conn);
//http://windows.php.net/downloads/pecl/releases/oci8/2.0.8/php_oci8-2.0.8-5.5-ts-vc11-x64.zip	
?>	

<div class = "home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>

</body>
</html>