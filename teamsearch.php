<!DOCTYPE html>
<html>
<head>
<script src="sorttable.js"></script>
	<title>Team Search</title>
<style type="text/css">
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
	#mainNavigation {
  background-color: #FDF3E7;
  position: fixed;
  float: left;
  padding-right: 15.8%;
  padding-bottom: 20%;
}

#otherContent {
  background-color: #C63D0F;
  color: white;
  float: right;
  padding-top: 10%;
  padding-bottom: 50%;
  padding-left: 21%;
  padding-right: 7%;
  width: 44%;
  /*overflow-y:scroll; */
}
label, input {
    display: block;
}

label {
    margin-bottom: 20px;
}
</style>	
</head>
<body>
<div id="mainNavigation">
<h2>Search</h2>
<form action="" method="post">
	<label>
		Club
		<input id="club" name="club" type="text"></input>
	</label>
		Previous
		<input name="previous" type="number"></input>
	<label class="radio-inline">
	  <select name="radio">
      <option value="season">Season
      <option value="gameweek">Gameweeks
      </select>

    <label>
    <br>
    	League<br>
    	<select name="leagues">
    	<option value="1">Barclays Premier League
    	<option value="3">Ligue 1
    	<option value="4">La Liga
    	<option value="2">Bundesliga
    	<option value="5">Championship England
    	<option value="6">Ligue 2
    	<option value="7">Segunda
    	<option value="8">2. Bundesliga
    	</select>
    </label>
		Shots on Goal(Greater than)
		<input id="shg" name="shotsongoal" type="number"></input>
	
	<!-- <label> -->
		Shots on target(Greater than)
		<input id="sht" name="shotsontarget" type="number"></input>
	<!-- </label> -->
	<!-- <label> -->
		Fouls(Less than)
		<input id="fouls" name="fouls" type="number"></input>
	<!-- </label> -->
	<!-- <label> -->
		Corners(Greater than)
		<input id="corners" name="corners" type="number"></input>
	<!-- </label> -->
	<!-- <label> -->
		Yellow Cards(Less than)
		<input id="yellowcard" name="yellowcard" type="number"></input>
	<!-- </label> -->
	<!-- <label> -->
		Red Cards(Less than)
		<input id="redcard" name="redcard" type="number"></input>
	<!-- </label> -->
	<br>
	<input type="submit">
</form>
</div>

<div id="otherContent">
<table class="sortable" border=1 cellpadding=5><tr><td>Club</td><td>Average Shots on Goal</td><td>Average Shots on Target</td><td>Average Fouls</td><td>Average Corners</td><td>Average Yellow Cards</td><td>Average Red Cards</td><td>Total games played</td></tr>
<?php
	include 'connection.php';
	if($_POST)
	{
		$club = $_POST['club'];
		$previous = $_POST['previous'];
		$radio = $_POST['radio'];
		// echo "$radio";
		$shotsongoal = $_POST['shotsongoal'];
		$shotsontarget = $_POST['shotsontarget'];
		$fouls = $_POST['fouls'];
		$corners = $_POST['corners'];
		$ycards = $_POST['yellowcard'];
		$rcards = $_POST['redcard'];
		$league = $_POST['leagues'];
	}

	// $sql = 'SELECT DISTINCT played_c.homeclub FROM game,game_stat,played_c WHERE 1=1 AND played_c.gid=game.gid AND played_c.gid=game_stat.gid';
	if(empty($previous))
	{

	$sql1 = 'select DISTINCT homeclub as club,trunc((hsh+ash)/(a+b),2) as avg_shots_on_goal,trunc((hst+ast)/(a+b),2) as avg_shots_on_target, 
      trunc((hf+af)/(a+b),2) as avg_fouls_committed,trunc((hc+ac)/(a+b),2) as avg_corners,
      trunc((hy+ay)/(a+b),2) as avg_yellow_cards,trunc((hr+ar)/(a+b),2) as avg_red_cards,
      (a+b) as total_number_of_games_played
from      (select homeclub,sum(hsh)as hsh,sum(hst)as hst,sum(hf)as hf,
                sum(hc)as hc,sum(hy)as hy,sum(hr)as hr,count(*)as a
        from played_c,game_stat
        where played_c.gid = game_stat.gid
        group by homeclub),
        (select awayclub,sum(ash)as ash,sum(ast)as ast,sum(af)as af,
               sum(ac)as ac,sum(ay)as ay,sum(ar)as ar,count(*)as b
        from played_c,game_stat
        where played_c.gid = game_stat.gid
        group by awayclub)
where homeclub = awayclub';
	}
	if(!empty($previous))
	{
		if($radio=='gameweek')
		{
	$sql1 = 'select DISTINCT homeclub as club,trunc((hsh+ash)/(a+b),2) as avg_shots_on_goal,trunc((hst+ast)/(a+b),2) as avg_shots_on_target, 
      trunc((hf+af)/(a+b),2) as avg_fouls_committed,trunc((hc+ac)/(a+b),2) as avg_corners,
      trunc((hy+ay)/(a+b),2) as avg_yellow_cards,trunc((hr+ar)/(a+b),2) as avg_red_cards,
      (a+b) as total_number_of_games_played
from      (select homeclub,sum(hsh)as hsh,sum(hst)as hst,sum(hf)as hf,
                sum(hc)as hc,sum(hy)as hy,sum(hr)as hr,count(*)as a
        from played_c,game_stat
        where played_c.gid = game_stat.gid and
        played_c.gid in (select g.gid from played_c p, league l, game g
                         where l.lid = p.lid and g.gid = p.gid
                         and g.season <= trunc(:nm/l.gameweeks,0)

                         union

                        select g.gid from played_c p, league l, game g
                        where l.lid = p.lid and g.gid = p.gid
                        and g.season = trunc(:nm/l.gameweeks,0)+1
                        and g.GAMEWEEK <=:nm-(trunc(:nm/l.gameweeks,0)*l.gameweeks))
        group by homeclub),
        (select awayclub,sum(ash)as ash,sum(ast)as ast,sum(af)as af,
               sum(ac)as ac,sum(ay)as ay,sum(ar)as ar,count(*)as b
        from played_c,game_stat
        where played_c.gid = game_stat.gid and
        played_c.gid in (select g.gid from played_c p, league l, game g
                         where l.lid = p.lid and g.gid = p.gid
                         and g.season <= trunc(:nm/l.gameweeks,0)

                         union

                        select g.gid from played_c p, league l, game g
                        where l.lid = p.lid and g.gid = p.gid
                        and g.season = trunc(:nm/l.gameweeks,0)+1
                        and g.GAMEWEEK <=:nm-(trunc(:nm/l.gameweeks,0)*l.gameweeks))
        group by awayclub)
		where homeclub = awayclub';
		}
		if($radio=='season'){
			$sql1 = 'select DISTINCT homeclub as club,trunc((hsh+ash)/(a+b),2) as avg_shots_on_goal,trunc((hst+ast)/(a+b),2) as avg_shots_on_target, 
      trunc((hf+af)/(a+b),2) as avg_fouls_committed,trunc((hc+ac)/(a+b),2) as avg_corners,
      trunc((hy+ay)/(a+b),2) as avg_yellow_cards,trunc((hr+ar)/(a+b),2) as avg_red_cards,
      (a+b) as total_number_of_games_played
from      (select homeclub,sum(hsh)as hsh,sum(hst)as hst,sum(hf)as hf,
                sum(hc)as hc,sum(hy)as hy,sum(hr)as hr,count(*)as a
        from played_c,game_stat
        where played_c.gid = game_stat.gid and
        played_c.gid in (select g.gid from played_c p, league l, game g
                         where l.lid = p.lid and g.gid = p.gid
                         and g.season <= :nm)
        group by homeclub),
        (select awayclub,sum(ash)as ash,sum(ast)as ast,sum(af)as af,
               sum(ac)as ac,sum(ay)as ay,sum(ar)as ar,count(*)as b
        from played_c,game_stat
        where played_c.gid = game_stat.gid and
        played_c.gid in (select g.gid from played_c p, league l, game g
                         where l.lid = p.lid and g.gid = p.gid
                         and g.season <= :nm)
        group by awayclub)
		where homeclub = awayclub';
		}	 
	}


	if(!empty($club))
	{
		$sql1 .=" AND homeclub LIKE '%$club%'";
	}

	if(!empty($league))
	{	
		$sql1 .=" and homeclub in (select distinct homeclub from played_c
									where lid = $league)";
	}

	if(!empty($shotsongoal))
	{
		$sql1 .=" AND trunc((hsh+ash)/(a+b),2)>=$shotsongoal";
	}

	if(!empty($shotsontarget))
	{
		$sql1 .=" AND trunc((hst+ast)/(a+b),2)>=$shotsontarget";
	}

	if(!empty($fouls))
	{
		$sql1 .=" AND trunc((hf+af)/(a+b),2)<=$fouls";
	}

	if(!empty($corners))
	{
		$sql1 .=" AND trunc((hc+ac)/(a+b),2)>=$corners";
	}

	if(!empty($ycards))
	{
		$sql1 .=" AND trunc((hy+ay)/(a+b),2)<=$ycards";
	}

	if(!empty($rcards))
	{
		$sql1 .=" AND trunc((hr+ar)/(a+b),2)<=$rcards";
	}

	$query1 = oci_parse($conn, $sql1);
	if(!empty($previous))
		oci_bind_by_name($query1, ':nm', $previous);
	oci_execute($query1);
	//echo $query1;

	while (($row = oci_fetch_array($query1, OCI_BOTH)) != false) {
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
oci_free_statement($query1);
oci_close($conn);
?>
</div>
<div class = "home">
	<a href="index.php"><h2 id="homepage">FOOTYSTATS</h2></a>
</div>
</body>
</html>