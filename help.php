

$sql1 = 'select homeclub,sum(hsh)as hsh,sum(hst)as hst,sum(hf)as hf,
             sum(hc)as hc,sum(hy)as hy,sum(hr)as hr,count(*)as a
        	 from played_c,game_stat
        	 where played_c.gid = game_stat.gid
        	 group by homeclub';
    $sql2 = 'select awayclub,sum(ash)as ash,sum(ast)as ast,sum(af)as af,
             sum(ac)as ac,sum(ay)as ay,sum(ar)as ar,count(*)as b
        	 from played_c,game_stat
        	 where played_c.gid = game_stat.gid
        	 group by awayclub';    	 
	$sql = 'select DISTINCT homeclub as club,trunc((hsh+ash)/(a+b),2) as "avg_shots_on_goal",trunc((hst+ast)/(a+b),2) as avg_shots_on_target, 
      		trunc((hf+af)/(a+b),2) as avg_fouls_committed,trunc((hc+ac)/(a+b),2) as avg_corners,
      		trunc((hy+ay)/(a+b),2) as avg_yellow_cards,trunc((hr+ar)/(a+b),2) as avg_red_cards,
      		(a+b) as total_number_of_games_played
	  		from';

	if(empty($previous)){
		$sql .="(" . $sql1 . ")," . "(" . $sql2 . ")" . "where homeclub = awayclub";
	}

	if(!empty($club))
	{
		$sql .=" AND homeclub LIKE '%$club%'";
	}
	if(!empty($previous))
	{
		
	}

	if(!empty($league))
	{	
		$sql .=" AND homeclub in (select distinct homeclub from played_c where lid = $league)";
	}

	if(!empty($shotsongoal))
	{
		$sql .=" AND avg_shots_on_goal>=$shotsongoal";
	}

	if(!empty($shotsontarget))
	{
		$sql .=" AND avg_shots_on_target >=$shotsontarget";
	}

	if(!empty($fouls))
	{
		$sql .=" AND avg_fouls_committed<=$fouls";
	}

	if(!empty($corners))
	{
		$sql .=" AND avg_corners>=$corners";
	}

	if(!empty($ycards))
	{
		$sql .=" AND avg_yellow_cards<=$ycards";
	}

	if(!empty($rcards))
	{
		$sql .=" AND avg_red_cards<=$rcards";
	}