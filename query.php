<!DOCTYPE html>
<head><script src="sorttable.js"></script></head>
<style type="text/css">
	body {
  margin: 0px;
}
a:link{
		text-decoration: none;
	}
#mainNavigation {
  background-color: #FDF3E7;
  position: fixed;
  float: left;
  padding-right: 10%;
  padding-bottom: 20%;
}

#otherContent {
  background-color: #C63D0F;
  color: white;
  float: right;
  /*margin: 0px;*/
  padding-top: 10%;
  padding-bottom: 50%;
  padding-left: 50%;
  padding-right: 5%;
  /*width: 50%;*/
}
label, input {
    display: block;
}

label {
    margin-bottom: 20px;
}
div.home{
		position: absolute;
		top: 0;
		right: 0;
	}
#homepage{
		color: #FDF3E7;
	}
</style>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<title>Player Search</title>
<div id="mainNavigation">
<h2>Player Search</h2>
  <form action="" method="post">
  	<label>
  		Name
  		<input id="name" name="name" type="text"></input>
  	</label>
  	<label>
  		Position
  		<select  id="position" name="position">
  			<option value="blank"></option>
  			<option value="RW">RW</option>
  			<option value="ST">ST</option>
  			<option value="LW">LW</option>
  			<option value="CM">CM</option>
  			<option value="CDM">CDM</option>
  			<option value="RM">RM</option>
  			<option value="LB">LB</option>
  			<option value="LM">LM</option>
  			<option value="CF">CF</option>
  			<option value="CAM">CAM</option>
  			<option value="CB">CB</option>
  			<option value="RB">RB</option>
  			<option value="LWBx	">LWB</option>
  		</select>
  	</label>
  	<label>
  		Goals Greater than
  		<input type="number" name="goals"></input>
  	</label>
  	<label>
  		Previous Seasons
  		<select name="seasons">
  			<option value="0"></option>
  			<option value="1">1</option>
  			<option value="2">2</option>
  			<option value="3">3</option>
  		</select>
  	</label>
  	<label>
  		Top N results
  		<input type="number" name="rows"></input>
  	</label>
  	<label>
  		Age Range
  		<label>
  			Min
  			<input type="number" name="minimum"></input>
  		</label>
  		<label>
  			Max
  			<input type="number" name="maximum"></input>
  		</label>	
  	</label>
  	<input type="submit">
  </form>
</div>

<div id="otherContent">
<table class="sortable" border=1 cellpadding=5><tr><td>Name</td><td>Age</td><td>Club</td><td>Rating</td><td>Pace</td><td>Shooting</td><td>Passing</td><td>Dribbling</td><td>Defending</td><td>Physical</td><td>Goals</td></tr>
  <?php 
  include 'connection.php';
  if($_POST){
  	$name = $_POST['name'];
  	$position = $_POST['position'];
  	$goals = $_POST['goals'];
  	$season = $_POST['seasons'];
  	$tuples = $_POST['rows'];
  	$minage = $_POST['minimum'];
  	$maxage = $_POST['maximum'];
  	// echo "$position";
  	// echo "$name";
  	// echo "$minage";
  	// $query1 = oci_parse($conn,'SELECT * FROM dual WHERE 1=1');
  	// $query1 = oci_parse($conn,'SELECT name,rating,pace,shooting,passing,dribbling,defending,physical FROM outfield_player WHERE 1=1');
  	if(empty($season)){
  		$sql = 'SELECT outfield_player.name,player.age,player.club,outfield_player.rating,outfield_player.pace,outfield_player.shooting,outfield_player.passing,outfield_player.dribbling,outfield_player.defending,outfield_player.physical,player.goals FROM outfield_player,player WHERE outfield_player.name=player.name';
  	}
  	if(!empty($season) and !empty($goals)){
  		$sql = 'SELECT outfield_player.name,player.age,player.club,outfield_player.rating,outfield_player.pace,outfield_player.shooting,outfield_player.passing,outfield_player.dribbling,outfield_player.defending,outfield_player.physical,goalSeason FROM outfield_player,player,
  									(select scoredby as name1, count(*) as goalSeason from game_scoredby 
  									where gid in(select gid from game where season<=:s)
  									group by scoredby
  									having count(*)>:g)
  				WHERE outfield_player.name=player.name  and player.name=name1';
  	}
  	// if(!empty($tuples))
  	// {
  	// 	$sql .=" rownum<=$tuples";
  	// }

  	if (!empty($name))
  	{
  		$sql .=" AND outfield_player.name LIKE '%$name%'";
  		// oci_bind_by_name($query1,':nm', $name);
  	}
  	if($position!='blank')
  	{
  		$sql .=" AND position='$position'";
  	}
  	if(!empty($minage))
  	{
  		$sql .=" AND player.age>=$minage";
  	}
  	if(!empty($maxage))
  	{
  		$sql .=" AND player.age<=$maxage";
  	}
  	if(empty($season) and !empty($goals))
  	{
  		$sql .=" AND player.goals>=$goals";
  	}
  	// if(!empty($season) and !empty($goals))
  	// {
  	// 	$sql .=" AND player.name in (select scoredby,count(*) from game_scoredby 
  	// 								where gid in(select gid from game where season<=$season)
  	// 								group by scoredby
  	// 								having count(*)>$goals)";
  	// }

  	if(!empty($tuples))
  	$sql = " select * from (" . $sql . " ORDER BY rating DESC) where ROWNUM<=$tuples ";

  	if(empty($tuples))
  		$sql .=" ORDER BY rating DESC";
  	// $sql2 = "select scoredby,count(*) from game_scoredby 
  	// 		 where gid in(select gid from game where season<=$season)
  	// 		 group by scoredby
  	// 		having count(*)>$goals";
  	$query1 = oci_parse($conn, $sql);

  	// echo $sql;
  	// if(!empty())
  	// oci_bind_by_name($query1,':nm', $name);
  	// oci_bind_by_name($query1, ':pos', $position);
  	// oci_bind_by_name($query1, ':row', $tuples);
  	if(!empty($season) and !empty($goals)){
		oci_bind_by_name($query1, ':g', $goals);
  		oci_bind_by_name($query1, ':s', $season);
  	}
  	oci_execute($query1);
  	while (($row=oci_fetch_array($query1, OCI_BOTH)) != false){
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
		<td><?php echo $row[8] ?></td>
		<td><?php echo $row[9] ?></td>
		<td><?php echo $row[10]?></td>
 		 </tr>
		<?php
	}
	
oci_free_statement($query1);
oci_close($conn);
  }
   ?>
</div>
<div class = "home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</html>