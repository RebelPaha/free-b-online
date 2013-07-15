<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><?
	include('config.php');

	date_default_timezone_set('Europe/Kiev');
	$new_file="./mem.csv";
//	$sql="TRUNCATE TABLE member";
//	mysql_query($sql,$db);
	$f = fopen($new_file, "r");
	header('Content-type: text/html; charset="utf-8"');
	setlocale(LC_ALL, 'ru_RU.CP1251');
	echo 'setlocale='.setlocale(LC_ALL, 'ru_RU.CP1251');
	$begin=0;
	$col_id=0;
	$col_unknown=0;
	$i=0;
	$halyava=0;
	$diller=0;
?>
<table border="1">
<tr>
 <td>№ карты</td>
 <td>Диллер</td>
 <td>Фамилия</td>
 <td>Имя</td>
 <td>Отчество</td>
 <td>Телефон</td>
 <td>Пол</td>
 <td>e-mail</td>
 <td>День рожденья</td>
 <td>Дата регистрации</td>
 <td>Продавец магазина id</td>
 <td>Халявщик</td>
 <td>Результат</td>
</tr> 
<?
	while ($data=fgetcsv($f,65535,";"))
	{
		if($begin)
		{
			$data[0]=str_repeat('0',9-strlen($data[0])).$data[0];
			if($data[1]) $data[1]=str_repeat('0',9-strlen($data[1])).$data[1];
			$data[2]=iconv("cp1251", "utf-8", $data[2]);
			$data[3]=iconv("cp1251", "utf-8",  $data[3]);
			$data[4]=iconv("cp1251", "utf-8",  $data[4]);	
			$sql="SELECT id FROM member WHERE number_card='".$data[0]."' OR phone='".$data[6]."' LIMIT 1";			
			if($row=mysql_fetch_row(mysql_query($sql,$db))||empty($data[6])||empty($data[0]))
			{
			?>
<tr bgcolor="#FF0000" style="color:#fff;">
 <td><? echo $data[0]; ?></td>
 <td><? echo $data[1]; ?></td>
 <td><? echo $data[2]; ?></td>
 <td><? echo $data[3]; ?></td>
 <td><? echo $data[4]; ?></td>
 <td><? if($data[5]) echo 'М'; else echo 'Ж' ?></td>
 <td><? echo $data[6]; ?></td>
 <td><? echo $data[7]; ?></td>
 <td><? echo $data[8]; ?></td>
 <td><? echo $data[9]; ?></td>
 <td><? echo $data[10]; ?></td>
 <td><? echo $data[11]; ?></td> 
 <td><? if(empty($data[6])) echo 'нет ТЕЛЕФОНА';
elseif(empty($data[0])) echo 'нет № карточки.';
else echo 'Такая карта или моб.телефон уже существуют в базе';
		 ?></td>
</tr>
<?						$col_unknown++;
	
				continue;
			}		

			$login=$data[6];
			$pwd=md5($data[0]);								
			$sql="SELECT id FROM member WHERE number_card='".$data[1]."' LIMIT 1";
			if($row=mysql_fetch_row(mysql_query($sql,$db)))
			{
				$id_mem=$row[0];
				$diller++;
			}
			else echo 'Диллер не найден...........';

			$sql="INSERT INTO member SET
	number_card='".$data[0]."', 
	login='".$login."', 
	password='".$pwd."',
	f_name='".$data[3]."',	
	s_name='".$data[4]."',	
	t_name='".$data[2]."',	
	phone='".$data[6]."',
	birthday='".date("Y-m-d",strtotime($data[8]))."',	
	email='".$data[7]."',	
	balls='0',change_balls='0', saved_money='0',country='Украина', 
	city='Херсон', sex='".$data[5]."',	datereg='".date("Y-m-d",strtotime($data[9]))."', all_balls='0', all_product='0', 
	parent='".$id_mem."', balance='0', diller='".$data[10]."'";
	mysql_query($sql,$db) or die('Реферал не добавлен. Ошибка записи в б/д');		
			$col_id++;
			if($data[11]!='1')
			{
				$halyava+=6;
			}
			?>
<tr>
 <td><? echo $data[0]; ?></td>
 <td><? echo $data[1]; ?></td>
 <td><? echo $data[2]; ?></td>
 <td><? echo $data[3]; ?></td>
 <td><? echo $data[4]; ?></td>
 <td><? if($data[5]) echo 'М'; else echo 'Ж' ?></td>
 <td><? echo $data[6]; ?></td>
 <td><? echo $data[7]; ?></td>
 <td><? echo $data[8]; ?></td>
 <td><? echo $data[9]; ?></td>
 <td><? echo $data[10]; ?></td>
 <td><? echo $data[11]; ?></td> 
 <td>Добавлен</td>
</tr>
<?
		}
		else $begin=1;		
	}
	echo '</table>Незарегистрированных пользователей = '.$col_unknown.'<br>Зарегистрированных пользователей = '.$col_id;
	echo '<br>Стоимость карточек = '.$halyava.'<br>Кол-во диллеров = '.$diller;
	fclose($f);
?>
