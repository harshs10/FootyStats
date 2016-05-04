<!DOCTYPE html>
<html>
<head>
	<title>Dream Team</title>
	<style type="text/css">
	body{
		background-image: url("dreamteam.jpg");
		background-size: cover;
	}

	h2{
		color: white;
	}

	#result{
		/*background-color: orange;*/
	}
	#homepage{
		position: absolute;
		top: 0;
		right: 0;
		color: white;
	}
	h4{
		/*color: white;*/
	}
	a:link{
		text-decoration: none;
	}
	</style>
</head>
<body>
<div id="formpart">
<h3 style="color: white">Formations</h3>
<form action="" method="post">
	<select name="formations">
		<!-- <option value=""></option> -->
		<option value="4-4-2">4-4-2</option>
		<option value="4-3-3">4-3-3</option>
		<option value="3-4-3">3-4-3</option>
		<option value="4-5-1">4-5-1</option>
		<option value="3-5-2">3-5-2</option>
		<option value="3-4-2-1">3-4-2-1</option>
		<option value="5-2-2-1">5-2-2-1</option>
		<option value="4-2-3-1">4-2-3-1</option>
		<option value="4-1-4-1">4-1-4-1</option>
		<option value="4-4-1-1">4-4-1-1</option>
		<option value="4-3-1-2">4-3-1-2</option>
		<option value="4-2-2-2">4-2-2-2</option>
	</select>

	<input type="submit"></input>
</form>



</div>

<div id="result">

<?php

include 'connection.php';
$formation=0;
if($_POST)
{
	$formation = $_POST['formations'];
}
$array=array();
$y=0;
$x=0;
for($x;$x<strlen($formation);$x+=2)
{
	$array[$y]=$formation[$x];
	$y++;
}

for($i=0;$i<count($array);++$i)
{
	// print gettype($array[$i]);
}

if(count($array)==3)
{
	$def = (int) $array[0];
	$mid = (int) $array[1];
	$att = (int) $array[2];
	echo "<h2>Defenders</h2>";
	$sqldef = 'select name from (select name from outfield_player where position= \'CB\' or position = \'RB\' or position = \'LB\' order by rating desc) where rownum <= :nm';

	$sqlmid = 'select name from (select name from outfield_player where position = \'RM\' or position = \'LM\' or position = \'CM\' or position = \'CDM\' or position = \'LWB\' order by rating desc) where rownum <= :nl';

	$sqlatt = 'select name from (select name from outfield_player 
                         where position = \'RW\'
                         or position = \'LW\'
                         or position = \'CF\'
                         or position = \'ST\'
                         order by rating desc) where rownum <= :no';

    $stid1 = oci_parse($conn,$sqldef);
    $stid2 = oci_parse($conn,$sqlmid);
    $stid3 = oci_parse($conn,$sqlatt);

    oci_bind_by_name($stid1, ':nm', $def);
    oci_bind_by_name($stid2, ':nl', $mid);
    oci_bind_by_name($stid3, ':no', $att);
    oci_execute($stid1);
    oci_execute($stid2);
    oci_execute($stid3);



    while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}


echo "<h2>Midfielders</h2>";

	while (($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}

echo "<h2>Strikers</h2>";

	while (($row = oci_fetch_array($stid3, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}

echo "<h2>Goalkeeper</h2>";

echo "<b>Manuel Neuer</b>";

}

if(count($array)==4)
{
	$def = (int) $array[0];
	$defmid = (int) $array[1];
	$mid = (int) $array[2];
	$att = (int) $array[3];	

	echo "<h2>Defenders</h2>";
	$sqldef = 'select name from (select name from outfield_player where position= \'CB\' or position = \'RB\' or position = \'LB\' order by rating desc) where rownum <= :nm';

	$sqldefmid = 'select name from (select name from outfield_player where position = \'CDM\' order by rating desc) where rownum <= :nl';

	$sqlmid = 'select name from (select name from outfield_player where position = \'RM\' or position = \'LM\' or position = \'CM\' or position = \'CDM\' or position = \'LWB\' order by rating desc) where rownum <= :nx';

	$sqlatt = 'select name from (select name from outfield_player 
                         where position = \'RW\'
                         or position = \'LW\'
                         or position = \'CF\'
                         or position = \'ST\'
                         order by rating desc) where rownum <= :no';

    $stid1 = oci_parse($conn,$sqldef);
    $stid2 = oci_parse($conn,$sqldefmid);
    $stid3 = oci_parse($conn,$sqlmid);
    $stid4 = oci_parse($conn,$sqlatt);

    oci_bind_by_name($stid1, ':nm', $def);
    oci_bind_by_name($stid2, ':nl', $defmid);
    oci_bind_by_name($stid3, 'nx', $mid);
    oci_bind_by_name($stid4, ':no', $att);


    oci_execute($stid1);
    oci_execute($stid2);
    oci_execute($stid3);
    oci_execute($stid4);

    while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}


echo "<h2>Center Defensive Midfielders</h2>";

	while (($row = oci_fetch_array($stid2, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}

echo "<h2>Midfielders</h2>";

	while (($row = oci_fetch_array($stid3, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}


echo "<h2>Strikers</h2>";

	while (($row = oci_fetch_array($stid4, OCI_BOTH)) != false) {
   		echo "<b>$row[0]</b><br>";
}

echo "<h2>Goalkeeper</h2>";

echo "<b>Manuel Neuer</b>";

}

?>
</div>

<div class="home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>

</body>
</html>