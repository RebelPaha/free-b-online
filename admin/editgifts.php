<?php
//echo addSlash($edit);
// -- Здесь задается обновление базы данных для каждого пользователя,
// -- т.е. когда мы сохраняем или отменяет, то выполняется определенное действие --
if ($_POST['Save_Admin'])
{			
	$_POST['textdesc']=str_replace('="../img','="./img',$_POST['textdesc']);
	$sql="UPDATE orders SET dateorder='".$_POST['dateorder']."', id_user='".$_POST['id_user']."', id_product='".$_POST['id_product']."',number='".$_POST['number']."',balls='".$_POST['balls']."',link_url='".$_POST['url']."',status='".$_POST['status']."',message='".$_POST['textdesc']."',id_vender='".$_POST['id_vender']."' WHERE id='".$_GET['edit']."'";
	$result=mysql_query($sql,$db) or die("Mysql error - ".mysql_error());
	echo '<script language="javascript">
	top.location.href="./'.$url_page.'";
	</script>';
}
if ($_POST['Cancel'])
{			
	echo '<script language="javascript">
	top.location.href="./'.$url_page.'";
	</script>';
}
// -- Если просто изменяем параметры подарка	
if($_GET['edit']&&is_numeric($_GET['edit']))
{
	if($_SESSION['lvl']==0) $level='Save_Admin';
	elseif($_SESSION['lvl']==1) $level='Save_SEO';
	$sql="SELECT * FROM orders WHERE id='".$_GET['edit']."'";
	$res=mysql_query($sql,$db) or die("Mysql error - ".mysql_error());
	$row=mysql_fetch_row($res);
?>
<form method="post">
<fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;"><legend>&nbsp;Описание подарка&nbsp;</legend>
 <table cellpadding="0" cellspacing="6" border="0" width="100%">
 <tr>
   <td valign="top" width="50px">Когда приобретено</td>
   <td valign="top" align="left"><input type="text" size="20" name="dateorder" value="<?php echo $row[0]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="50px">id пользователя</td>
   <td valign="top" align="left"><input type="text" size="10" name="id_user" value="<?php echo $row[1]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="50px">id товара</td>
   <td valign="top" align="left"><input type="text" size="10" name="id_product" value="<?php echo $row[2]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="50px">Сколько заказал</td>
   <td valign="top" align="left"><input type="text" size="10" name="number" value="<?php echo $row[3]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="50px">Сколько баллов потрачено</td>
   <td valign="top" align="left"><input type="text" size="10" name="balls" value="<?php echo $row[4]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="150px">URL товара</td>
   <td valign="top" align="left"><input type="text" size="50" name="url" value="<?php echo $row[5]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="50px">id вендора</td>
   <td valign="top" align="left"><input type="text" size="10" name="id_vender" value="<?php echo $row[8]; ?>"></td>
 </tr>
  <tr>
   <td valign="top" width="50px">Результат</td>
   <td valign="top" align="left"><input type="text" size="10" name="status" value="<?php echo $row[6]; ?>"></td>
 </tr>

 <tr>
   <td valign="top">Текст</td>
   <td valign="top" align="left"><textarea id="textdesc" name="textdesc"><?php echo $row[7]; ?></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'textdesc', {
	filebrowserBrowseUrl : './ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : './ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : './ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : 
 	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
	filebrowserImageUploadUrl : 
	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
	filebrowserFlashUploadUrl : './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
			</script>
	</td>
 </tr>
 </table>
 </fieldset><br />
 <div align="center">
<input type="submit" name="Save_Admin" value="Сохранить">&nbsp;&nbsp;<input type="submit" name="Cancel" value="Отмена">
</div>
</form>
<?php
} else {
?>
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
<?php
	// -- Делаем запрос на выборку. Все в одном запросе, чтобы уменьшить кол-во запросов к базе, тем самым увеличив производительность --
	$query = "SELECT p.name, m.t_name, m.f_name, m.s_name, o.dateorder, o.number, o.balls, v.name, o.status, o.id
              FROM `orders` o
			  LEFT JOIN `member`  m ON(o.id_user = m.id)
			  LEFT JOIN `vender`  v ON(o.id_vender = v.id)
			  LEFT JOIN `product` p ON(o.id_product = p.id)
			  ORDER by m.t_name ASC";
	$mysql_query = mysql_query($query,$db) or die('Ошибка - '.mysql_error());
	while($fetchArray = mysql_fetch_array($mysql_query))
	{
	?>
	<tr class="main" onclick="top.location.href='<? echo $url_page; ?>&edit=<? echo $fetchArray[9]; ?>'">
	<?php
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
<?php
}
?>