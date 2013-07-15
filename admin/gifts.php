<table class="gifts">
<tr class="header">
	<td>Название подарка</td>
	<td>Кто заказал</td>
	<td>Когда заказал</td>
	<td>Сколько заказал</td>
	<td>Сколько баллов потрачено</td>
	<td>Кто предоставляет подарок</td>
	<td>Результат</td>
</tr>
<tr class="main">
<?php
	// -- Делаем запрос на выборку. Все в одном запросе, чтобы уменьшить кол-во запросов к базе, тем самым увеличив производительность --
	$query = "SELECT p.name, m.t_name, m.f_name, m.s_name, o.dateorder, o.number, o.balls, v.name, o.status
              FROM `orders` o
			  LEFT JOIN `member`  m ON(o.id_user = m.id)
			  LEFT JOIN `vender`  v ON(o.id_vender = v.id)
			  LEFT JOIN `product` p ON(o.id_product = p.id)";
	$mysql_query = mysql_query($query,$db) or die('Ошибка - '.mysql_error());
	while($fetchArray = mysql_fetch_array($mysql_query))
	{
		//$fetchArray[8] = 0;
		// -- Если не выполнен запрос, тогда нужно, чтобы вся строка была красной. Пока выделяется все слова в строке, для наглядности --
		if($fetchArray[8] == 1) $tdError = "<td>";
		else $tdError = "<td class=\"error\">";
		// -- Выводим все нужные данные --
		echo $tdError.$fetchArray[0].'</td>';
		echo $tdError.$fetchArray[1].' '.$fetchArray[2].' '.$fetchArray[3].'</td>';
		echo $tdError.$fetchArray[4].'</td>';
		echo $tdError.$fetchArray[5].'</td>';
		echo $tdError.$fetchArray[6].'</td>';
		echo $tdError.$fetchArray[7].'</td>';
		// -- Чтобы вывести слово в конце, надо сделать еще раз проверку --
		if($fetchArray[8] == 1) $tdError.= 'Обработан';
		else $tdError.= 'Не обработан';
		// -- И вывести слово --
		echo $tdError.'</td>';
	}
?>
</tr>
<table>