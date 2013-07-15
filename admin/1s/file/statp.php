<?php 
// % прибыли => statv.php; Держатели карт => statm.php; Контрагенты => statp.php; Карточки покупателей => statc.php;
// -- Для дебага --
//ini_set('display_errors',1);
//error_reporting(E_ALL); 
// -- /Для дебага --

//<!-- Вывод одного вендера -->
if(is_numeric($_GET['diller']))
{ ?>
<!-- Сортировка по дате -->
<form method="post">
<div style="float:left;">
По дате<br>
от <input type="date" name="fromd" value="" maxlength="10"> Пример: 24.05.2012<br>
до <input type="date" name="tod" value=""  maxlength="10"> Пример: 27.05.2012<br>
</div>
<div style="clear:left"></div>
<input type="submit" name="search" value="Поиск">
</form>
<?php echo '<br><br>Посетители'; ?>
<!-- /Сортировка по дате -->
<!-- Таблица вывода шапки о пользователе.  -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<tr bgcolor="#3A6EA5">
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&diller=<?php echo $_GET['diller']; ?>&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Дата</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&diller=<?php echo $_GET['diller']; ?>&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Ф.И.О</a></th> 
</tr>
<!-- /Шапка таблицы -->
<?
	// -- Выбор метода сортировки --
		switch ($_GET['order'])
		{
			case 1: $orders='id_vender'; break;
			case 2: $orders='name';break;
			case 3: $orders='member_history.date_buy';break;
			case 4: $orders='member_card';break;
			case 5: $orders='summa';break;
			case 6: $orders='discount';break;
			case 7: $orders='freeb_summa';break;
			default: $orders='date_buy';
		}
		if($_GET['sort']) $ascdesc='ASC';
		else $ascdesc='DESC';
	// -- /Выбор метода сортировки --
	// -- Поиск и выборка -- 
		if($_POST['search'])
		{
			// -- Заменяем все другие символы в дате на те, что нужно --
			$_POST['fromd']=str_replace(',','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('/','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('.','-',$_POST['fromd']);
			$_POST['tod']=str_replace(',','-',$_POST['tod']);
			$_POST['tod']=str_replace('/','-',$_POST['tod']);
			$_POST['tod']=str_replace('.','-',$_POST['tod']);
			if(!empty($_POST['fromd'])) {
			if(!empty($_POST['tod']))
			{
			// -- И задаем sql-запрос по какой дате искать --
				$where.=" AND member_history.date_buy BETWEEN '".date("Y-m-d",strtotime($_POST['fromd']))."' AND '".date("Y-m-d",strtotime($_POST['tod']))."'";
			}
			else {
				$where.=" AND member_history.date_buy>='".date("Y-m-d",strtotime($_POST['fromd']))."'";
				}
				}
		}
	// -- Собственно запрос для выборки всего, что нам нужно включая поиск --
		$sql3="SELECT * FROM `member` JOIN `member_history`
			   ON (member.id=member_history.id_user)
			   WHERE member_history.wherefromballs=".$_GET['diller'].$where." ORDER BY ".$orders." ".$ascdesc;
		//$sql2="SELECT name, date_buy, price, wherefromballs FROM member_history WHERE id='0' AND id_user='".$_GET['']."'".$where." ".$orderby;
		//echo $sql3;
		$res2=mysql_query($sql3,$db);
		unset($_POST);
		if(!$row2=mysql_fetch_row($res2)) echo mysql_error();
	// -- Вывод данных в виде таблицы и суммирование потраченных денег и наших заработков -- 
		while($row2=mysql_fetch_row($res2))
		{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;">
 <td align="center" style="padding: 4px 12px;"><?php echo date("d.m.Y",strtotime($row2[28]));?></td>
 <td style="padding: 4px 12px;"><?php echo $row2[5].=' '.$row2[3].=' '.$row2[4];  ?></td>
</tr>
<?
		}
	}
else { ?>
<!-- /Вывод одного вендера -->
<!-- Вывод всех вендеров -->
<form method="post">
<div style="float:left; margin-right:20px;" >
По вендеру<br>
<select name="vendor[]" MULTIPLE SIZE=5 multiple="multiple">
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
<!-- /Список вендеров -->
<!-- Поиск по дате -->
<form method="post">
<div style="float:left;">
По дате<br>
от <input type="date" name="fromd" value="" maxlength="10"> Пример: 24.05.2012<br>
до <input type="date" name="tod" value=""  maxlength="10"> Пример: 27.05.2012<br>
</div>
<div style="clear:left"></div>
<input type="submit" name="search" value="Поиск">
</form>
<!-- /Поиск по дате -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<!-- Шапка для вывода информации -->
<tr bgcolor="#3A6EA5">
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=1&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">id</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=2&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Контрагент</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=3&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Дата оплаты</a></th>
 <th align="center" style="padding: 4px 12px;"><a href=".?stat=<? echo $_GET['stat'];?>&order=6&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Дисконт(%)</a></th> 
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=7&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Прибыль</a></th>
</tr>
<!-- /Шапка для вывода информации -->
<?
	// -- Выбор метода сортировки --
		switch ($_GET['order'])
		{
			case 1: $orders='id_vender'; break;
			case 2: $orders='name';break;
			case 3: $orders='date_buy';break;
			case 4: $orders='member_card';break;
			case 5: $orders='summa';break;
			case 6: $orders='discount';break;
			case 7: $orders='freeb_summa';break;
			default: $orders='date_buy';
		}
		if($_GET['sort']) $ascdesc='ASC';
		else $ascdesc='DESC';
	// -- /Выбор метода сортировки --
	// -- Задан ли поиск --
		if($_POST['search'])
		{
			// -- Заменяем все другие символы в дате на те, что нужно --
			$_POST['fromd']=str_replace(',','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('/','-',$_POST['fromd']);
			$_POST['fromd']=str_replace('.','-',$_POST['fromd']);
			$_POST['tod']=str_replace(',','-',$_POST['tod']);
			$_POST['tod']=str_replace('/','-',$_POST['tod']);
			$_POST['tod']=str_replace('.','-',$_POST['tod']);
			if(!empty($_POST['fromd'])) {
			if(!empty($_POST['tod']))
			{
			// -- И задаем sql-запрос по какой дате искать --
				$where.=" date_buy BETWEEN '".date("Y-m-d",strtotime($_POST['fromd']))."' AND '".date("Y-m-d",strtotime($_POST['tod']))."'";
			}
			else {
				$where.=" date_buy>='".date("Y-m-d",strtotime($_POST['fromd']))."'";
				}
				}
		}
	// -- /Поиск --
	// -- Выборка всех записей вендеров с таблицы stat_vender --
	// -- Присваиваем переменной результат поиска --
		$vender=$_POST['vendor'];
	// -- Загоняем все это в массив --
		$v=implode(',',$vender);
	// -- Если выбраны "Все", тогда пропускаем это все --
		if($v != NULL) {
	// -- Если заданы еще временные рамки тогда включаем их. Если выбраны вендеры, тогда идем по этому алгоритму --
		if($_POST['fromd'] OR $_POST['tod']) {
		$sql="SELECT * FROM stat_vender WHERE id_vender IN (".$v.") AND".$where." ORDER BY ".$orders." ".$ascdesc;
		} else { 
	// -- Если нет временных рамок, тогда без них --
		$sql="SELECT * FROM stat_vender WHERE id_vender IN (".$v.") ORDER BY ".$orders." ".$ascdesc;
		}
		} else {
	// -- Если выбраны "Все" или только зашли на страничку, показываем всех вендеров --
	// -- Если есть временные рамки --
		if($_POST['fromd'] OR $_POST['tod']) {
		$sql="SELECT * FROM stat_vender WHERE".$where." ORDER BY ".$orders." ".$ascdesc;
		} else {
	// -- Если нет временных рамок --
		$sql="SELECT * FROM stat_vender ORDER BY ".$orders." ".$ascdesc;
		}
		}
		//echo $sql;
		unset($_POST);
		$res=mysql_query($sql,$db);
		$summa=0;
		while($row=mysql_fetch_row($res))
		{
		// -- Подчитываем общую сумму --
			$summa+=$row[7];
?>
<!-- Выводим все в виде столбцов в таблице -->
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;" onClick="top.location.href='?stat=<? echo $_GET['stat'];?>&diller=<? echo $row[0]; ?>'">
 <td align="center" style="padding: 4px 12px;"><? echo $row[0];?></td>
 <td align="center" style="padding: 4px 12px;"><? echo $row[1];?></td>
 <td align="center" style="padding: 4px 12px;"><? echo date("d.m.Y",strtotime($row[2]));?></td>
 <td align="center" style="padding: 4px 12px;"><? echo $row[6];?></td> 
 <td align="center" style="padding: 4px 12px;"><? echo $row[7];?></td>
</tr>
<!-- /Вывод -->
<?		
		}
	// -- /Выборка всех записей вендеров с таблицы stat_vender --
?>
</table>
<!-- Вывод всей суммы -->
<div style="position:absolute; left: 870px; top:30px;; font-size:20px; color:#F00;">
Итого:
<?
echo $summa;
}
?>
</div>