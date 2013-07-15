<?php 
// % прибыли => statv.php; Держатели карт => statm.php; Контрагенты => statp.php;
// -- Для дебага --
//ini_set('display_errors',1);
//error_reporting(E_ALL); 
// -- /Для дебага --
?>
<!-- Поиск -->
<form method="post">
<div style="clear:left"></div>
<input type="text" name="name"></input>
<input type="submit" name="search" value="Поиск">
</form>
<!-- /Поиск -->
<!-- Основная таблица -->
<table cellspacing="1" bgcolor="#999999" cellpadding="4" border="0">
<!-- Шапка таблицы для вывода данных -->
<tr bgcolor="#3A6EA5">
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=1&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Покупатель</a></th>
 <th align="center" style="padding: 4px 12px;"><a href="?stat=<? echo $_GET['stat'];?>&order=2&<? if($_GET['sort']==1) echo 'sort=0';
  else echo 'sort=1';  ?>">Откуда карточка</a></th>
</tr>
<!-- /Шапка таблицы для вывода данных -->
<?
	// -- Выбор метода сортировки --
		switch ($_GET['order'])
		{
			case 2: $orders='diller'; break;
			case 1: $orders='t_name';break;
			default: $orders='t_name';
		}
		if($_GET['sort']) $ascdesc='ASC';
		else $ascdesc='DESC';
		// -- Поиск и выборка -- 
		if($_POST['search'])
		{
			if($_POST['name'] != NULL) {
			$where .= " WHERE member.t_name LIKE \"".$_POST['name']."\"";
			}
		}
	// -- /Выбор метода сортировки --
	// -- Выборка всех записей вендеров с таблицы --
		$sql="SELECT f_name, s_name, t_name, diller, name FROM member
		JOIN vender ON (member.diller=vender.id)".$where."
		ORDER BY ".$orders." ".$ascdesc;
		$res=mysql_query($sql,$db);
		if(!$res) echo mysql_error();
		while($row=mysql_fetch_row($res))
		{
?>
<!-- Выводим все в виде столбцов в таблице -->
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;">
 <td align="center" style="padding: 4px 12px;"><?php echo $row[2].' '.$row[0].' '.$row[1]; ?></td>
 <td align="center" style="padding: 4px 12px;"><?php echo $row[4]; ?></td>
</tr>
<!-- /Вывод -->
<?		
		}
	// -- /Выборка всех записей вендеров с таблицы --
?>
</table>