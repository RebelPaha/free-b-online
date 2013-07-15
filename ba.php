<?  include('config.php'); 
	$id_vender=26;
	
	$all_sum=0;
	$sum1=0;
	$sum2=0;
	$c1=0;
	$c2=0;
	$people=array();
	$sql="SELECT member_id, summa, member_card FROM stat_vender WHERE id_vender='".$id_vender."'";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
		$s=1;
		foreach($people as $val)
		{
			if($val==$row[2])
			{
				$s=0;
				break;
			}
		}
		if($s)
		{
			$people[]=$row[2];
		}
		$all_sum+=$row[1];
		$sql1="SELECT parent FROM member WHERE id='".$row[0]."'";
		$res1=mysql_query($sql1,$db) or die($sql1);
		if($row1=mysql_fetch_row($res1))
		{
			$sql2="SELECT diller FROM member WHERE id='".$row1[0]."'";
			$res2=mysql_query($sql2,$db) or die($sql2);;
			foreach($people as $val)
			if($row2=mysql_fetch_row($res2))
			{
				if($row2[0]==$all_sum) 
				{
					$sum1+=$row[1];
					if($S==0) $c1+=1;
				}
				else 
				{
					$sum2+=$row[1];
					if($S==0) $c2+=1;
				}
			}
		}
	}
	print_r($people);
	echo 'Всего зарегистрированных покупок = '.$all_sum;
	echo '<br>Из них по их картам: '.$sum1.'. Кол-во людей = '.$c1;
	echo '<br>Остальные: '.$sum2.'. Кол-во людей = '.$c2;
?>
