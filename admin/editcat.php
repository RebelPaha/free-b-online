<?
	if($_POST['save'])
	{
		foreach($_POST['categ'] as $k=>$val)
		  if($val!=$_POST['old_cat'][$k]) 
		  {
			  $sql="UPDATE categories SET category_name='".mysql_real_escape_string($val)."' WHERE id='".$k."'";
			  mysql_query($sql,$db);
		  }
		echo 'Удачно сохранено';  
		
	}
	
	if($_POST['add']&&$_POST['add_btn'])
	{
		$sql="INSERT INTO categories SET category_name='".mysql_real_escape_string($_POST['add'])."',count_vender='0',count_product='0',active_v='0',active_p='0'";
		mysql_query($sql,$db);
			echo 'Добавлена новая рубрика '.$_POST['add'];  
	}
	
	if($_POST['refresh'])
	{
	   foreach($_POST['categ'] as $k=>$val)
       {
		  $sql="SELECT * FROM vender WHERE category='".$k."'";
		  $num_cat=mysql_num_rows(mysql_query($sql,$db));
		  $sql="SELECT * FROM vender WHERE category='".$k."' AND active='1'";
		  $num_cata=mysql_num_rows(mysql_query($sql,$db));
		  $sql="UPDATE categories SET count_vender='". $num_cat."', active_v='".$num_cata."' WHERE id='".$k."'";
		  mysql_query($sql,$db) or die('Не пересчитало магазины');
		  
		  $sql="SELECT * FROM product WHERE category='".$k."'";
		  $num_cat=mysql_num_rows(mysql_query($sql,$db));
		  $sql="SELECT * FROM product WHERE category='".$k."' AND active='1'";
		  $num_cata=mysql_num_rows(mysql_query($sql,$db));
		  $sql="UPDATE categories SET 	count_product='". $num_cat."', active_p='".$num_cata."' WHERE id='".$k."'";
		  mysql_query($sql,$db) or die('Не пересчитало товары');
		  
	   }
	   echo 'Удачно пересчитано'; 
	}
?>
<form method="post">
<table cellpadding="2" cellspacing="2" border="0" width="100%" >
  <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td width="300">Название</td><td>Кол-во Магазинов</td><td>Кол-во Активных магазинов</td><td>Кол-во товаров</td><td>Активных товаров</td>
  </tr> 
<?
		$sql="SELECT * FROM categories";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
		while($row=mysql_fetch_row($res))
		{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>">
<td><input type="text" size="35" maxlength="20" name="categ[<? echo $row[0];?>]" value='<?php echo stripslashes($row[1]);?>'>
<input type="hidden" name="old_cat[<? echo $row[0];?>]" value="<? echo stripslashes($row[1]);?>"></td>
<td align="center"><? echo $row[2];?></td>
<td align="center"><? echo $row[4];?></td>
<td align="center"><? echo $row[3];?></td>
<td align="center"><? echo $row[5];?></td>
</tr>
<?
		}
?>
  <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td colspan="5"><input language='javascript' onclick="return confirm('Вы действительно хотите сохранить все категории?')" type="submit" value="Сохранить" name="save">&nbsp;&nbsp;<input type="submit" value="Отмена" name="cancel">&nbsp;&nbsp;<input type="submit" value="Пересчет" name="refresh"></td>
  </tr> 
   <tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
	<td colspan="5"><input type="text" size="35" name="add" maxlength="20" value="">&nbsp;&nbsp;<input type="submit" value="Добавить" name="add_btn"></td>
  </tr> 
</table>
</form>