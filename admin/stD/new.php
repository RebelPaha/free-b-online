<?
	$one_fB=50;
	$all_balls=0;
	$new=180;

	
	$ostatok=$all_balls-(floor($all_balls/$one_fB)*$one_fB);
	$balls=floor(($ostatok+$new)/$one_fB);
	$all_balls+=$new;	
	echo 'Summa - '.$all_balls.'. Ostatok = '.($ostatok+$new).'. fB=:50 =>'.$balls.'. FLOOR => fb='.$balls.'<br>';

	
	$ostatok=$all_balls-(floor($all_balls/$one_fB)*$one_fB);
	$balls=floor(($ostatok+$new)/$one_fB);
	$all_balls+=$new;	
	echo 'Summa - '.$all_balls.'. Ostatok = '.($ostatok+$new).':50 =>'.$balls.'. FLOOR => fb='.$balls.'<br>';

	$ostatok=$all_balls-(floor($all_balls/$one_fB)*$one_fB);
	$balls=floor(($ostatok+$new)/$one_fB);
	$all_balls+=$new;	
	echo 'Summa - '.$all_balls.'. Ostatok = '.($ostatok+$new).'=:50 =>'.$balls.'. FLOOR => fb='.$balls.'<br>';

?>