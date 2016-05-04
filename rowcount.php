<!DOCTYPE html>
<html>
<head>
	<title>Row Count</title>

	<style type="text/css">

	body{
		background-color: #C63D0F;
	}
		div.home{
		position: absolute;
		top: 0;
		right: 0;
	}

#homepage{
		color: #FDF3E7;
	}
	a:link{
		text-decoration: none;
	}
	#result{
		font-color: #FDF3E7;
	}
	</style>
</head>
<body>

	<?php
	include 'connection.php';
	$sql = "select sum(count) from ( select
table_name,
to_number(
   extractvalue(
      xmltype(
         dbms_xmlgen.getxml('select count(*) c from '||table_name))
,'/ROWSET/ROW/C')) count
from user_tables)";

	$query = oci_parse($conn, $sql);

	oci_execute($query);

	while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
	{?>
	
	<tr>

	<td id="result">Number of rows in the database :<?php echo $row[0]?></td>
	<?php }

	oci_free_statement($query);
	oci_close($conn);
	?>

	<div class = "home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>