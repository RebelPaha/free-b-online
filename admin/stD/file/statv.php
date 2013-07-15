<?php 
// % прибыли => statv.php; Держатели карт => statm.php; Контрагенты => statp.php; Карточки покупателей => statc.php;
// -- Для дебага --
//ini_set('display_errors',1);
//error_reporting(E_ALL); 
// -- /Для дебага --
?>
<!-- Список вендеров -->
<form method="post">
<div style="float:left; margin-right:20px;" >
По вендеру<br>
<select name="vendor">
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
<!-- Дата -->
<div style="float:left;">
По дате<br>
от <input type="date" name="fromd" value="" maxlength="10"> Пример: 24.05.2012<br>
до <input type="date" name="tod" value=""  maxlength="10"> Пример: 27.05.2012<br>
</div>
<!-- /Дата -->
<!-- Поиск -->
<div style="clear:left"></div>
<input type="submit" name="search" value="Поиск">
</form>
<!-- /Поиск -->
<!-- Основная таблица -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<!-- Шапка таблицы для вывода данных -->
<tr bgcolor="#3A6EA5">
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=1&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">id</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=2&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Контрагент</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=3&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Дата покупки</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=4&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Номер карты (клиента)</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=5&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Сумма покупки</a></th> 
 <th align="center" style="padding: 4px 12px;"><a href=".?stat=<? echo $_GET['stat'];?>&order=6&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Дисконт(%)</a></th> 
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=7&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Прибыль</a></th>
</tr>
<!-- /Шапка таблицы для вывода данных -->
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
			if($_POST['vendor']||(!empty($_POST['fromd'])&&!empty($_POST['tod']))) $where="WHERE ";		
			if($_POST['vendor']) $where.="id_vender=".$_POST['vendor'];
			if(!empty($_POST['fromd'])&&!empty($_POST['tod']))
			{
		 		if($_POST['vendor']) $where.=" AND "; 
				$where.="date_buy>='".date("Y-m-d",strtotime($_POST['fromd']))."' AND date_buy<='".date("Y-m-d",strtotime($_POST['tod']))."'";
			}
		}
	// -- /Поиск --
	// -- Выборка всех записей вендеров с таблицы stat_vender --
		$sql="SELECT * FROM stat_vender ".$where." ORDER BY ".$orders." ".$ascdesc;
//		echo $sql; 
//		echo $_POST['fromd'],$_POST['tod'];
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
else { $odd=1; echo "odd";}?>" style="cursor:pointer;">
 <td align="center" style="padding: 4px 12px;"><? echo $row[0];?></td>
 <td align="center" style="padding: 4px 12px;"><? echo $row[1];?></td>
 <td align="center" style="padding: 4px 12px;"><? echo date("d.m.Y",strtotime($row[2]));?></td>
 <td align="center" style="padding: 4px 12px;"><? echo $row[4];?></td>
 <td align="center" style="padding: 4px 12px;"><? echo $row[5];?></td> 
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
?>
</div>