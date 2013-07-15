<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>

<script type="text/javascript">
  VK.init({apiId: 2983964, onlyWidgets: true});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, width: "699", attach: "*"});
</script>
today is <? echo date("y m d   H:i:s");?>
<table border="1" cellpadding="5">
<tr>
 <td>Название</td>
 <td>Цена</td>
 <td>Количество</td>
 <td>Дата окончания</td>
</tr>
<?
include('config.php');
		$sql="SELECT name, price,  count_prod, expiration_date FROM product WHERE active='1' ORDER BY category ASC";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
	
		while($row=mysql_fetch_row($res))
		{	
?>
<tr>
 <td><? echo $row[0];?></td>
 <td><? echo $row[1];?></td>
 <td><? echo $row[2];?></td>
 <td><? echo $row[3];?></td>
</tr>
<?
		}
?>
</body>
</html>