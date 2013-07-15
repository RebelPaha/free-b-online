<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?
include('config.php');
if($_POST['addfb']&&$_FILES['upload'])
{
	$namefile=iconv("utf-8", "cp1251", $_FILES['upload']['name']);
	copy($_FILES['upload']['tmp_name'],$namefile);

	date_default_timezone_set('Europe/Kiev');
	$new_file=$namefile;
	$f = fopen($new_file, "r");

	$begin=0;
	$count=0;
	$bad_count=0;
	$summa=0;
	$one_fB=50;  /// free-B балл = 50

	$sql="SELECT discount, referal, name, our_earn FROM vender WHERE id='".$_POST['vender']."' AND active='1' LIMIT 1";
	$res=mysql_query($sql,$db);
	if($row=mysql_fetch_row($res))
	{
		$disc=$row[0];
		$referal_disc=$row[1];
		$name_vender=$row[2];
		$our_earn=$row[3];
?>
<table border="1">
<tr>
 <td>Дата</td>
 <td>№ карты</td>
 <td>Сумма</td>
 <td>Результат</td>
 <td>Его дилер</td>
</tr> 
<?	
	while ($data=fgetcsv($f,65535,";"))
	{
		if($begin&&!empty($data[0]))
		{
			$data[0]=date("Y-m-d",strtotime($data[0]));
			$data[1]=str_repeat('0',9-strlen($data[1])).$data[1];
			$data[2]=str_replace(',','.',$data[2]);
			$summa+=$data[2];
			?>
<tr>
 <td><? echo $data[0]; ?></td>
 <td><? echo $data[1]; ?></td>
 <td><? echo $data[2]; ?></td>
 <?  
 		$sql="SELECT id, parent, all_balls, balls, saved_money, all_money FROM member WHERE number_card='".$data[1]."' LIMIT 1";
		if($row=mysql_fetch_row(mysql_query($sql,$db)))
		{
			$id_user=$row[0];
			$parent=$row[1];
			$all_balls=$row[2];
			$balls_user=$row[3];
			$saved_user=$row[4];
			$all_money=$row[5];
		}
		else
		{
			echo '<td colspan="2" style="color:#fff; background-color:#ff0000;">Такого номера карты нет в базе!!!</td></tr>';
			$bad_count++;
			$count++;
			continue;
		}
// проверка на существование такой записи
			$sql="SELECT * FROM member_history WHERE wherefromballs='".$_POST['vender']."' AND id_user='".$id_user."' AND id='0' AND date_buy='".$data[0]."' AND price='".$data[2]."' LIMIT 1";
			echo $sql.'<br>';
			if($row=mysql_fetch_row(mysql_query($sql,$db)))
			{
				echo '<td colspan="2" style="color:#fff; background-color:#ff0000;">Такая запись уже существует!!!</td></tr>';
				$bad_count++;
				$count++;
				continue;
			}
// проверка на существование такой записи

			if($data[4]) $data[4]=(float)$data[4];
			if(is_numeric($data[4])) $saved=floor($data[2]*$data[4])/100;
			else $saved=floor($data[2]*$disc)/100;
			
		 	$balls=floor(($all_money-(floor($all_money/$one_fB)*$one_fB)+$data[2])/$one_fB); /// ФОРМУЛА подсчета fB баллов
				
			$sql="INSERT INTO member_history SET id='0', id_user='".$id_user."', wherefromballs='".$_POST['vender']."', name='".$name_vender."', date_buy='".$data[0]."', price='".$data[2]."', saved='".$saved."', balls='".$balls."'";
			mysql_query($sql,$db) or die('Невозможно записать '.$sql);
			
			if($data[4]) $disc_tmp=$data[4];
			else $disc_tmp=$our_earn;
			$sql="INSERT INTO stat_vender SET id_vender='".$_POST['vender']."', name='".$name_vender."', member_id='".$id_user."', member_card='".$data[1]."', date_buy='".$data[0]."', summa='".$data[2]."', discount='".$our_earn."', freeb_summa='".(floor($our_earn*$data[2])/100)."'";
	 		mysql_query($sql,$db) or die($sql);
			
			$data[2]=(int)$data[2];
			if($data[2]>0) 
			{
				$all_balls+=$balls;					
				$balls_user+=$balls;
				$saved_user+$saved;
				//echo $all_money.'+'.$data[2];
				$all_money+=$data[2];
				//echo '='.$all_money;
				
				$sql="UPDATE member SET all_balls='".$all_balls."', balls='".$balls_user."',saved_money='".$saved."',all_money='".$all_money."' WHERE id='".$id_user."'";
				mysql_query($sql,$db) or die('Невозможно обновить '.$sql);
				if($balls>0)
				{
					$msg='Вам начислено '.$balls.' fB';	
					$sql="INSERT INTO member_mail SET id_user='".$id_user."', read_m='0', message='".$msg."', datemsg='".date("Y-m-d H:i:s")."'";
					mysql_query($sql,$db) or die('Невозможно записать '.$sql);
				}
			}		
			echo '<td>Добавлен<br>';
			$count++;		
?></td>
 <td><? if($parent>0) 
			{
				//echo $data[2];
				$award=floor($data[2]*$referal_disc)/100;
				$sql="SELECT balance, number_card FROM member WHERE id='".$parent."'";
				$res=mysql_query($sql,$db);
				if($row=mysql_fetch_row($res))
				{
					$balance=$row[0]+$award;
				}
				$sql="UPDATE member SET balance='".$balance."' WHERE id='".$parent."'";
				mysql_query($sql,$db);
				echo 'Дилер ';
				echo $row[1].', % ='.$referal_disc.', начислено = '.$award;
				if($award>0)
				{
					$msg='Вам начислено '.$award.' грн.';
					$sql="INSERT INTO member_mail SET id_user='".$parent."', read_m='0', message='".$msg."', datemsg='".date("Y-m-d H:i:s")."'";
					mysql_query($sql,$db) or die($sql);
				}
				$sql="INSERT INTO member_backcash SET id='0', id_user='".$parent."', wherefromballs='".$id_user."', 
				date_buy='".$data[0]."', 
				price='".$data[2]."', 
				discont='".$referal_disc."', 
				balls='".$award."'";
				//echo $sql;
				mysql_query($sql,$db) or die($sql);
			}
			else echo 'Нет дилера';
			 ?></td>
</tr>
<?			
		}
		else $begin=1;
	}
	// статистика
	//echo $sql.'<br>';
	echo '</table>----------------------------------------------<br>Вендер: '.$name_vender.'<br>';
	echo 'Кол-во записей в файле: '.$count.'<br>';
	echo 'Кол-во НЕ СОХРАНЕННЫХ: '.$bad_count.'<br>';
	echo 'Сумма дохода: '.$summa.'<br>';
	echo '% free B: '.round($our_earn*$summa/100,2).'<br>';

	}
	else
	{
		echo 'Не найден id вендера!!! Обратитесь к администратору';
	}
	fclose($f); 
	unlink($new_file); 
}
?>

<form enctype="multipart/form-data" method="post" onSubmit="return confirm('Проверьте правильно ли выбран ВЕНДЕР?')">
Файл для загрузки <input type="file" name="upload">
Выберите вендера <select name="vender">
<? 
	$sql="SELECT id, name FROM vender WHERE active='1' ORDER BY name";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
?><option value=<? echo $row[0];?>><? echo $row[1];?></option><?
	}
?>
  </select>
  <input type="submit" value="Добавить" name="addfb">
</form>