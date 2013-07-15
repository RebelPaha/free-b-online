<?php 
// % прибыли => statv.php; Держатели карт => statm.php; Контрагенты => statp.php; Карточки покупателей => statc.php;
// -- Для дебага --
//ini_set('display_errors',1);
//error_reporting(E_ALL); 
// -- /Для дебага --

$i = 0;
// Количество вывода строчек
$per_page = 20;
// Отсчет количества строк на первой странице
$start=0;

// -- Вывод рефералов клиента --
if($_GET['referal']==1)
{
	$sql="SELECT number_card, f_name, s_name, t_name, balls, balance FROM member WHERE id='".$_GET['ncard']."'";
	$res=mysql_query($sql,$db);
	if($row=mysql_fetch_row($res))
	{
		echo '№ карты&nbsp;- <b>'.$row[0].'</b><br>';
		echo 'Ф.И.О.&nbsp;&nbsp;- <b>'.$row[3].' '.$row[1].' '.$row[2].'</b><br><br>
РЕФЕРАЛЫ';
?>
<!-- Шапка таблицы для вывода всех значений -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<tr bgcolor="#3A6EA5">
 <td align="center" style="padding: 4px 12px;"><a href="">№ карты</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">Ф.И.О.</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">Сумма</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">% диллеру</a></td> 
</tr>
<!-- /Шапка таблицы -->
<?
		$sql1="SELECT id, number_card, f_name, s_name, t_name FROM member WHERE parent='".$_GET['ncard']."'";
		$res1=mysql_query($sql1,$db);
		while($row1=mysql_fetch_row($res1))
		{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;" onClick="top.location.href='?stat=<? echo $_GET['stat'];?>&ncard=<? echo $row1[0]; ?>'">
 <td align="center" style="padding: 4px 12px;"><? echo $row1[1];?></td>
 <td style="padding: 4px 12px;"><? echo $row1[4].' '.substr($row1[2],0,2).'.'.substr($row1[3],0,2).'.';?></td>
  <td align="center" style="padding: 4px 12px;"><? 
	$sql2="SELECT wherefromballs, price FROM member_history WHERE id='0' AND id_user='".$row1[0]."'";
	$res2=mysql_query($sql2,$db);
	$summary=0;
	$diller=0;
	while($row2=mysql_fetch_row($res2))
	{
		// Суммируем
		$summary+=$row2[1];
		$sql3="SELECT referal FROM vender WHERE id='".$row2[0]."'";
		$res3=mysql_query($sql3,$db);
		if($row3=mysql_fetch_row($res3))
		{
			$diller+=$row3[0]*$row2[1]/100;
		}
	}
	echo $summary;  
  ?></td>
 <td align="center" style="padding: 4px 12px;"><? echo ceil($diller*100)/100;?></td> 
</tr>
<?
		}	
	}
}
// -- /Вывод рефералов клиента --

////........////........////...........///...........///..........///...........///........../// Вывод данных о пользователе
elseif(is_numeric($_GET['ncard']))
{
	$sql="SELECT number_card, f_name, s_name, t_name, balls, balance, phone FROM member WHERE id='".$_GET['ncard']."'";
	$res=mysql_query($sql,$db);
	if($row=mysql_fetch_row($res))
	{
		echo '№ карты&nbsp;- <b>'.$row[0].'</b><br>';
		echo 'Ф.И.О.&nbsp;&nbsp;- <b>'.$row[3].' '.$row[1].' '.$row[2].'</b><br>';
		echo 'моб.&nbsp;&nbsp;- <b>'.$row[6].'</b><br>';
		$sql1="SELECT id FROM member WHERE parent='".$_GET['ncard']."'";
		$res1=mysql_query($sql1,$db);
		if(mysql_num_rows($res1)) echo '<a href="?stat='.$_GET['stat'].'&ncard='.$_GET['ncard'].'&referal=1">Рефералов&nbsp;- '.mysql_num_rows($res1).'<b></b></a><br><br>';
		else echo 'Рефералов нет<br><br>';

		echo 'Покупки';
?>
<!-- Вывод всех вендеров и сортировка по нему -->
<form method="post" enctype="multipart/form-data">
<div style="float:left; margin-right:20px;" >
По вендеру<br>
<select name="vendor[]" multiple="multiple" size="5">
<option value="">Все</option>
<?
	$sql="SELECT id, name FROM vender";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
 		echo '<option value="'.$row[0].'">'.$row[1].'</option>';
	}
?>
</select>
</div>
<!-- /Вывод всех вендеров -->
<!-- Сортировка по дате -->
<div style="float:left;">
По дате<br>
от <input type="date" name="fromd" value="" maxlength="10"> Пример: 24.05.2012<br>
до <input type="date" name="tod" value=""  maxlength="10"> Пример: 27.05.2012<br>
</div>
<div style="clear:left"></div>
<input type="submit" name="search" value="Поиск">
</form>
<!-- /Сортировка по дате -->
<!-- Таблица вывода шапки в пользователе. Сколько всего денег потрачено, сколько fb-баллов и наших денег  -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<tr bgcolor="#fff">
 <td align="center" style="padding: 4px 12px;"></td>
 <td align="center" style="padding: 4px 12px;">Итого</td>
 <td align="center" style="padding: 4px 12px;"><div id="itemsumma">грн.</div></td>
 <td align="center" style="padding: 4px 12px;"><div id="itemfb"></div></td>
 <td align="center" style="padding: 4px 12px;"><div id="itemsumma2"></div></td> 
</tr>
<tr bgcolor="#3A6EA5">
 <td align="center" style="padding: 4px 12px;"><a href="">Дата</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">Магазин</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">Сумма покупки</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">fB</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="">наш %</a></td> 
</tr>
<tr>
	<?php 
	// -- Выбор отчета для каждого пользователя --
		$sql = "SELECT * FROM `orders` WHERE id_user='".$_GET['ncard']."'"; 
		$query = mysql_query($sql,$db);
		while($row=mysql_fetch_row($query))
		{
		$sql = "SELECT `name` FROM `vender` WHERE id=".$row[8];
		$query = mysql_query($sql);
		$result = mysql_fetch_row($query);
		echo '<td align="center" style="padding: 4px 12px;">Вы потратили '.$row[4].'fB на <a href="http://'.
	// -- Сам переход на нужную страницу с покупкой --
					$_SERVER['SERVER_NAME'].'/'.$row[5]
					.'">'.$result[0].'</a></td>';
		}
	// -- /Выбор отчета для каждого пользователя --
	?>
</tr>
<!-- /Шапка таблицы -->
<?
	// -- Поиск и выборка -- 
		if($_POST['search'])
		{
			if(count($_POST['vendor'])>1) 
			{
			  foreach($_POST['vendor'] as $val)
			  {
				 if($ff) $where.=" OR ";
				 else {$where.=" AND (";$ff=1;}
			    $where.="wherefromballs='".$val."'";
			  }
			  $where.=")";
			}
			elseif($_POST['vendor'][0]) $where.=" AND wherefromballs='".$_POST['vendor'][0]."'";
		// -- Заменяем все другие символы в дате на те, что нужно --
			$_POST['fromd']=str_replace(',','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('/','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('.','-',$_POST['fromd']);
			$_POST['tod']=str_replace(',','-',$_POST['tod']);
			$_POST['tod']=str_replace('/','-',$_POST['tod']);
			$_POST['tod']=str_replace('.','-',$_POST['tod']);
			if(!empty($_POST['fromd'])&&!empty($_POST['tod']))
			{
			// -- И задаем sql-запрос по какой дате искать --
				$where.=" AND date_buy>='".date("Y-m-d",strtotime($_POST['fromd']))."' AND date_buy<='".date("Y-m-d",strtotime($_POST['tod']))."'";
			}
		}
	// -- Собственно запрос для выборки всего, что нам нужно включая поиск --
		$sql2="SELECT name, date_buy, price, wherefromballs FROM member_history WHERE id='0' AND id_user='".$_GET['ncard']."'".$where." ".$orderby;
//		echo $sql2;
		$res2=mysql_query($sql2,$db);
		$summary=0;
		$fBsumm=0;
		$our_earn=0;
	// -- Вывод данных в виде таблицы и суммирование потраченных денег и наших заработков -- 
		while($row2=mysql_fetch_row($res2))
		{
			$summary+=$row2[2];
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;">
 <td align="center" style="padding: 4px 12px;"><? echo date("d.m.Y",strtotime($row2[1]));?></td>
 <td style="padding: 4px 12px;"><? echo $row2[0];?></td>
 <td align="center"><? echo $row2[2];?> грн.</td>
 <td align="center"><? echo floor($row2[2]/$one_fB);?> fB</td>
 <td align="center"><? 
 			$sql3="SELECT our_earn FROM vender WHERE id='".$row2[3]."'";
			$res3=mysql_query($sql3,$db);
			if($row3=mysql_fetch_row($res3))
			{
				echo $row3[0]*$row2[2]/100;
				$our_earn+=$row3[0]*$row2[2]/100;
			}?> грн.</td>
</tr> 
<?
		}
		?>
	<!-- На лету меняем сумму, которая выводится в шапке таблицы покупателя -->
<script type="text/javascript">
  document.getElementById('itemsumma').innerHTML="<b style='color:#ff0000'><? echo $summary.' грн.';?></b>";
  document.getElementById('itemfb').innerHTML="<b style='color:#ff0000'><? echo floor($summary/$one_fB).' fB';?></b>";
  document.getElementById('itemsumma2').innerHTML="<b style='color:#ff0000'><? echo $our_earn.' грн.';?></b>";
</script>
<!-- /Вывод суммы -->
        <?
	}
}
//// Вывод всех пользователей
else
{
// Получаем номер страницы
if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;

// Вычисляем первый оператор LIMIT'a
$start=abs($page*$per_page);

?>
<form method="post">
 <input type="text" maxlength="9" name="n_card"><input type="submit" value="Поиск" name="search">
</form>
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<tr bgcolor="#3A6EA5" style="color:#FFF; font-weight: bold;">
 <td align="center"  style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&orders=1&<? if($_GET['by']==1) echo 'by=0';
  else echo 'by=1';  ?>">№ карты</a></td>
 <td align="center"  style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&orders=2&<? if($_GET['by']==1) echo 'by=0';
  else echo 'by=1';  ?>">Ф.И.О.</a></td>
 <td align="center" style="padding: 4px 12px;">Рефералов</td>
 <td align="center" style="padding: 4px 12px;">Потрачено в систему</td>
 <td align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&orders=5&<? if($_GET['by']==1) echo 'by=0';
  else echo 'by=1';  ?>">Неиспользовано fB</a></td>
 <td align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&orders=6&<? if($_GET['by']==1) echo 'by=0';
  else echo 'by=1';  ?>">Возврат</a></td>
 <td align="center" style="padding: 4px 12px;">% фирме</td>
 <td align="center" style="padding: 4px 12px;">Телефонный номер</td>
 <td align="center" style="padding: 4px 12px;">Номер карточки родителя</td>
</tr>
<?
	switch ($_GET['orders'])
	{
		case 1:$orderby="number_card";
		break;
		case 2:$orderby="t_name";
		break;
		case 3:$orderby="number_card";
		break;
		case 4:$orderby="number_card";
		break;
		case 5:$orderby="balls";
		break;
		case 6:$orderby="balance";
		break;
		case 7:$orderby="number_card";
		break;
		default:$orderby="number_card";		
	}
	if($_GET['by']) $orderby.=" DESC";
	else $orderby.=" ASC";
	
if($_POST['search']&&!empty($_POST['n_card']))	
{
	$_POST['n_card']=str_repeat('0',9-strlen($_POST['n_card'])).$_POST['n_card'];
	$sql="SELECT id, number_card, f_name, s_name, t_name, balls, balance FROM member WHERE number_card=".$_POST['n_card']." ORDER BY ".$orderby." LIMIT ".$start.",".$per_page;
}
else $sql="SELECT `id`, `number_card`, `f_name`, `s_name`, `t_name`, `balls`, `balance`, `parent`, `phone` FROM `member` ORDER BY ".$orderby." LIMIT ".$start.",".$per_page;
	$res=mysql_query($sql,$db);
	$i = mysql_num_rows($res);
	$a = mysql_num_fields($res);
	while($row=mysql_fetch_row($res))
	{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;" onClick="top.location.href='?stat=<? echo $_GET['stat'];?>&ncard=<? echo $row[0]; ?>'">
 <td align="center" style="padding: 4px 12px;"><? echo $row[1];?></td>
 <td style="padding: 4px 12px;"><? echo $row[4].' '.$row[2].' '.$row[3];?></td>
 <td align="center" style="padding: 4px 12px;"><? 
		$sql1="SELECT id FROM member WHERE parent='".$row[0]."'";
		$res1=mysql_query($sql1,$db);
		echo mysql_num_rows($res1); 
 ?></td>
 <td align="center"><?
	$sql1="SELECT wherefromballs, price FROM member_history WHERE id='0' AND id_user='".$row[0]."'";
	$res1=mysql_query($sql1,$db);
	$summary=0;
	$ourearn=0;
	while($row1=mysql_fetch_row($res1))
	{
		$summary+=$row1[1];
		$sql2="SELECT our_earn FROM vender WHERE id='".$row1[0]."'";
		$res2=mysql_query($sql2,$db);
		if($row2=mysql_fetch_row($res2))
		{
			$ourearn+=$row2[0]*$row1[1]/100;
		}
	}
	echo $summary;
 ?> грн.</td>
 <td align="center"><? echo $row[5];?> fB</td>
 <td align="center"><? echo $row[6];?> грн.</td>
 <td align="center"><? echo ceil($ourearn*100)/100; ?></td>
 <td align="center"><?php echo $row[8]; ?></td>
 <td align="center">
 <?php 
	// -- Если есть родитель тогда --
		if($row[7] > 0) {
		// -- делаем выборку по карточке  --
			$mysql_query="SELECT `number_card` FROM `member` WHERE id='".$row[7]."'";
			$result=mysql_query($mysql_query);
			$row3=mysql_fetch_row($result);
			echo $row3[0];
		} else {
			echo 'Не имеет родителя';
		}
 ?>
 </td> 
</tr> 
<?			
	}
	// Вычиляем, сколько всего строк в таблице
$q="SELECT count(*) FROM `member`";
$res=mysql_query($q);
$row=mysql_fetch_row($res);
$total_rows=$row[0];

// Вычисляем количество страниц
$num_pages=ceil($total_rows/$per_page);

// Выводим их
for($i=1;$i<=$num_pages;$i++) {
if($i-1 == $page) {
echo $i." ";
} else {
echo '<a href="http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?stat=2&page='.$i.'">'.$i."</a>";
}
}
?>
</table>
<?
}
?>