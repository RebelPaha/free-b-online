<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>
<script language="javascript">

function BrowseServer()
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '../../../../../img/product/';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField;
	finder.popup();

	// It can also be done in a single line, calling the "static"
	// popup( basePath, width, height, selectFunction ) function:
	// CKFinder.popup( '../', null, null, SetFileField ) ;
	//
	// The "popup" function can also accept an object as the only argument.
	// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl )
{
	document.getElementById( 'xFilePath' ).value = fileUrl;
}

	</script>
<? 
	if ($_POST['Cancel'])
	{			
		echo '<script language="javascript">
	top.location.href="./'.$url_cat.'";
	</script>';
	}	

	if ($_POST['Save_User'])
	{		
		if($_POST['action']=="on") $action=1;
		else $action=0;	
		if(strrpos($_POST['logo'],'/')) $_POST['logo']=substr($_POST['logo'],strrpos($_POST['logo'],'/')+1);
		$date=$_POST['expdays'];
		$_POST['textdesc']=str_replace('="../img','="./img',$_POST['textdesc']);
		if($_POST['status']=="on") $status=1;
		else $status=0;
		$sql="SELECT active FROM product WHERE id='".$_GET['edit']."'";
		$result=mysql_query($sql,$db);
		if($row=mysql_fetch_row($result)) $oldstatus=$row[0];
		$sql="UPDATE product SET name='".mysql_real_escape_string($_POST['name'])."',category='".$_POST['cat']."',price='".$_POST['price']."',our_price='".$_POST['our_price']."',balls='".$_POST['balls']."',image='".$_POST['logo']."',description='".mysql_real_escape_string($_POST['textdesc'])."',expiration_date='".$date."',active='".$status."', count_prod ='".$_POST['sum_col']."', action='".$action."', id_vender='".$_POST['id_vender']."' WHERE id='".$_GET['edit']."'";
		$result=mysql_query($sql,$db);
		if(!$result) echo("ошибка!!!!!");
		if($oldstatus!=$status)
		{
			if($status==0)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) $active=$row[0]-1;
				if($active>=0)
				{
					$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
					$result=mysql_query($sql,$db);
				}
			}
			elseif($status==1)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) echo $active=$row[0]+1;
				$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
				$result=mysql_query($sql,$db);
			}
		}
		if($_GET['category']!=$_POST['cat'])
		{
			if($status==0)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) $active=$row[0]-1;
				if($active>=0)
				{
					$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
					$result=mysql_query($sql,$db);
				}
			}
			elseif($status==1)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) echo $active=$row[0]+1;
				$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
				$result=mysql_query($sql,$db);
			}
		}
		echo '<script language="javascript">
	top.location.href="./'.$url_cat.'";
	</script>';
	}
	
	if ($_POST['Save_SEO'])
	{			
		$_POST['textdesc']=str_replace('="../img','="./img',$_POST['textdesc']);
		$sql="UPDATE product SET name='".mysql_real_escape_string($_POST['name'])."', description='".mysql_real_escape_string($_POST['textdesc'])."',html_title='".mysql_real_escape_string($_POST['title'])."',html_description='".mysql_real_escape_string($_POST['description'])."',html_keyword='".mysql_real_escape_string($_POST['keyword'])."' WHERE id='".$_GET['edit']."'";
		$result=mysql_query($sql,$db);
		if(!$result) echo("ошибка!!!!!");
		echo '<script language="javascript">
	top.location.href="./'.$url_cat.'";
	</script>';
	}

	if ($_POST['Save_Admin'])
	{			
		if($_POST['action']=="on") $action=1;
		else $action=0;
		if(strrpos($_POST['logo'],'/')) $_POST['logo']=substr($_POST['logo'],strrpos($_POST['logo'],'/')+1);
		$date=$_POST['expdays'];
		$_POST['textdesc']=str_replace('="../img','="./img',$_POST['textdesc']);
		if($_POST['status']=="on") $status=1;
		else $status=0;
		$sql="SELECT active FROM product WHERE id='".$_GET['edit']."'";
		$result=mysql_query($sql,$db);
		if($row=mysql_fetch_row($result)) $oldstatus=$row[0];
		$sql="UPDATE product SET name='".mysql_real_escape_string($_POST['name'])."',category='".$_POST['cat']."',price='".$_POST['price']."',our_price='".$_POST['our_price']."',balls='".$_POST['balls']."',image='".$_POST['logo']."',description='".mysql_real_escape_string($_POST['textdesc'])."',expiration_date='".$date."',active='".$status."',html_title='".mysql_real_escape_string($_POST['title'])."',html_description='".mysql_real_escape_string($_POST['description'])."',html_keyword='".mysql_real_escape_string($_POST['keyword'])."', count_prod ='".$_POST['sum_col']."', action='".$action."', id_vender='".$_POST['id_vender']."' WHERE id='".$_GET['edit']."'";
		$result=mysql_query($sql,$db);
		if(!$result) echo("ошибка!!!!!");
		if($oldstatus!=$status)
		{
			if($status==0)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) $active=$row[0]-1;
				if($active>=0)
				{
					$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
					$result=mysql_query($sql,$db);
				}
			}
			elseif($status==1)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) echo $active=$row[0]+1;
				$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
				$result=mysql_query($sql,$db);
			}
		}
		if($_GET['category']!=$_POST['cat'])
		{
			if($status==0)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) $active=$row[0]-1;
				if($active>=0)
				{
					$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
					$result=mysql_query($sql,$db);
				}
			}
			elseif($status==1)
			{
				$sql1="SELECT active_p FROM categories WHERE id='".$_POST['cat']."'";
				$result1=mysql_query($sql1,$db);
				if($row=mysql_fetch_row($result1)) echo $active=$row[0]+1;
				$sql="UPDATE categories SET active_p='".$active."' WHERE id='".$_POST['cat']."'";
				$result=mysql_query($sql,$db);
			}
		}
		echo '<script language="javascript">
	top.location.href="./'.$url_cat.'";
	</script>';
	}

	if ($_POST['Save_New'])
	{			
		if($_POST['action']=="on") $action=1;
		else $action=0;
		$_POST['logo']=substr($_POST['logo'],strrpos($_POST['logo'],'/')+1);
		$date=$_POST['expdays'];
		$_POST['textdesc']=str_replace('="../img','="./img',$_POST['textdesc']);
		$sql="INSERT INTO product SET name='".mysql_real_escape_string($_POST['name'])."',category='".$_POST['cat']."',price='".$_POST['price']."',our_price='".$_POST['our_price']."',balls='".$_POST['balls']."',image='".$_POST['logo']."',description='".mysql_real_escape_string($_POST['textdesc'])."',date_add='".date('Y-m-d H:i:s')."',expiration_date='".$date."',active='1',html_title='".mysql_real_escape_string($_POST['title'])."',html_description='".mysql_real_escape_string($_POST['description'])."',html_keyword='".mysql_real_escape_string($_POST['keyword'])."',count_prod = '".$_POST['sum_col']."', action='".$action."',
id_vender='".$_POST['id_vender']."'";
		$result=mysql_query($sql,$db) or die('Как раз тут и не работает');
		if($result)
		{
			$sql1="SELECT count_product, active_p FROM categories WHERE id='".$_POST['cat']."'";
			$result1=mysql_query($sql1,$db);
			if($row=mysql_fetch_row($result1))
			{
				$count=$row[0]+1;
				$active=$row[1]+1;
			}
			$sql="UPDATE categories SET count_product='".$count."', active_p='".$active."' WHERE id='".$_POST['cat']."'";
			$result=mysql_query($sql,$db);
		}
		echo '<script language="javascript">
	top.location.href="./'.$url_page.'";
	</script>';	
	}
	
	if ($_POST['DEL_SEO'])
	{			
		$sql="DELETE FROM product WHERE id='".$_GET['edit']."' LIMIT 1";
		$result=mysql_query($sql,$db);
		if($result)
		{
			$sql1="SELECT count_product, active_p FROM categories WHERE id='".$_GET['category']."'";
			$result1=mysql_query($sql1,$db);
			if($row=mysql_fetch_row($result1))
			{
				$count=$row[0]-1;
				$active=$row[1]-1;
			}
			if($count>=0)
			{
				$sql="UPDATE categories SET count_product='".$count."', active_p='".$active."' WHERE id='".$_GET['category']."'";
				$result=mysql_query($sql,$db);
			}
		}
		echo '<script language="javascript">
	top.location.href="./'.$url_cat.'";
	</script>';
	}
///  Добавление товара ....................................................................
if($_GET['add']==1)
{
?>
<form method="post">
<fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;"><legend>&nbspОписание товара&nbsp;</legend>
 <table cellpadding="0" cellspacing="6" border="0" width="100%">
 <tr>
   <td valign="top" width="150px">Наименование товара</td>
   <td valign="top" align="left"><input type="text" size="50" name="name" value=''></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Категория</td>
   <td valign="top" align="left"><select size="1" name="cat"><?
   $sql1="SELECT id, category_name FROM categories ORDER BY id ASC";
   $res1=mysql_query($sql1,$db);
	while($row1=mysql_fetch_row($res1))
	{
		echo '<option ';
		if($_GET['category']==$row1[0]) echo 'selected ';
		echo 'value="'.$row1[0].'">'.$row1[1].'</option>';
	}
   ?></select></td>
 </tr>
<tr>
   <td valign="top" width="150px">Цена</td>
   <td valign="top" align="left"><input type="text" size="15" name="price" value=''></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Наша цена</td>
   <td valign="top" align="left"><input type="text" size="15" name="our_price" value=''></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Баллов</td>
   <td valign="top" align="left"><input type="text" size="15" name="balls" value=''></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Логотип</td>
   <td valign="top" align="left"> <input id="xFilePath" name="logo" type="text" size="60" />
   <input type="button" value="Browse Server" onclick="BrowseServer();" /></td>
 </tr>

 <tr>
   <td valign="top" width="150px">Всего кол-во</td>
   <td valign="top" align="left"><input type="text" size="5" name="sum_col" value=''>&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Партнер предоставляющий подарок&nbsp;&nbsp;&nbsp;<select size="1" name="id_vender"><?
   $sql2="SELECT id, name FROM vender ORDER BY name ASC";
   $res2=mysql_query($sql2,$db);
	while($row2=mysql_fetch_row($res2))
	{
		echo '<option value="'.$row2[0].'">'.$row2[1].'</option>';
	}
   ?>
 	</select></td>
 </tr>
  <tr>
   <td valign="top" width="150px">Кол-во дней через которое может купить 1 человек этот товар</td>
   <td valign="top" align="left"><input type="text" size="8" name="expdays" value=''></td>
 </tr> 
 <tr>
   <td valign="top" width="150px">Акционный</td>
   <td valign="top" align="left"><input type="checkbox" name="action"></td>
 </tr>
 <tr>
   <td valign="top" colspan="2">Описание
   <textarea id="textdesc" name="textdesc"></textarea>
			<script type="text/javascript">
	CKEDITOR.replace('textdesc', {
	filebrowserBrowseUrl : './ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : './ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : './ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : 
 	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
	filebrowserImageUploadUrl : 
	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
	filebrowserFlashUploadUrl : './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
			</script></td>
 </tr>
 </table>
 </fieldset><br />
<div align="center">
<input type="submit" name="Save_New" value="Сохранить">&nbsp;&nbsp;<? if($_SESSION['lvl']==0) {?><input type="submit" name="DEL_SEO" value="Удалить">&nbsp;&nbsp;<? } ?><input type="submit" name="Cancel" value="Отмена"></div>
<? 
	if($_SESSION['lvl']<2)
	{
?>
 <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px;width:99%"><legend>&nbsp;SEO-оптимизация&nbsp;</legend>
 <table cellpadding="0" cellspacing="6" border="0" width="100%">
 <tr>
   <td valign="top" width="150px">&lt;Title&gt;</td>
   <td valign="top" align="left"><textarea name="title" cols="100" rows="3" ></textarea></td>
 </tr>
 <tr>
   <td valign="top">&lt;Description&gt;</td>
   <td valign="top" align="left"><textarea name="description" cols="100" rows="3" ></textarea></td>
 </tr>
 <tr>
   <td valign="top">&lt;Keyword&gt;</td>
   <td valign="top" align="left"><textarea name="keyword" cols="100" rows="3" ></textarea></td>
 </tr>
 </table>
 </fieldset><br />
 <div align="center">
<input type="submit" name="Save_New" value="Сохранить">&nbsp;&nbsp;<input type="submit" name="Cancel" value="Отмена"></div><?
	}
}
//  Редактирование товара ....................................................................
	elseif($_GET['edit']&&is_numeric($_GET['edit']))
	{
		$sql="SELECT * FROM product WHERE id='".$_GET['edit']."'";
		$res=mysql_query($sql,$db);
		if($row=mysql_fetch_row($res))
		{
			if($_SESSION['lvl']==0) $level='Save_Admin';
			elseif($_SESSION['lvl']==1) $level='Save_SEO';
			elseif($_SESSION['lvl']==2) $level='Save_User';
?>
<form method="post">
<fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;"><legend>&nbspОписание товара&nbsp;</legend>
 <div style="position: absolute; left: 1100px;" align="center">Превью товара<br>
<img src="../img/product/<? echo $row[6]; ?>" width="140px"></div>
 <table cellpadding="0" cellspacing="6" border="0" width="100%">
 <tr>
   <td valign="top" width="150px">Наименование товара</td>
   <td valign="top" align="left"><input type="text" size="50" name="name" value='<? echo stripslashes($row[1]); ?>'></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Категория</td>
   <td valign="top" align="left"><select size="1" name="cat"><?
   $sql1="SELECT id, category_name FROM categories ORDER BY id ASC";
   $res1=mysql_query($sql1,$db);
	while($row1=mysql_fetch_row($res1))
	{
		echo '<option ';
		if($row[2]==$row1[0]) echo 'selected ';
		echo 'value="'.$row1[0].'">'.$row1[1].'</option>';
	}
   ?></select></td>
 </tr>
<tr>
   <td valign="top" width="150px">Цена</td>
   <td valign="top" align="left"><input type="text" size="15" name="price" value="<? echo $row[3]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Наша цена</td>
   <td valign="top" align="left"><input type="text" size="15" name="our_price" value="<? echo $row[4]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Баллов</td>
   <td valign="top" align="left"><input type="text" size="15" name="balls" value="<? echo $row[5]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Логотип</td>
   <td valign="top" align="left"><input id="xFilePath" name="logo" type="text" size="60" value="<? echo $row[6]; ?>"/>
   <input type="button" value="Обзор на сервере" onclick="BrowseServer();" /></td>
 </tr>
  <tr>
   <td valign="top" width="150px">Всего кол-во</td>
   <td valign="top" align="left"><input type="text" size="5" name="sum_col" value="<?  echo $row[15]; ?>">&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Партнер предоставляющий подарок&nbsp;&nbsp;&nbsp;<select size="1" name="id_vender"><?
   $sql2="SELECT id, name FROM vender ORDER BY name ASC";
   $res2=mysql_query($sql2,$db);
	while($row2=mysql_fetch_row($res2))
	{
		echo '<option ';
		if($row[17]==$row2[0]) echo 'selected ';
		echo 'value="'.$row2[0].'">'.$row2[1].'</option>';
	}
   ?>
 	</select></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Дата добавления</td>
   <td valign="top" align="left"><input disabled type="text" size="20" name="date_add" value="<?  echo $row[8]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Кол-во дней через которое может купить 1 человек этот товар</td>
   <td valign="top" align="left"><input type="text" size="8" name="expdays" value="<? echo $row[9]; ?>"></td>
 </tr>
 <tr>
   <td valign="top" width="150px">Статус</td>
   <td valign="top" align="left"><? if($row[10]==1) echo '<input type="checkbox" checked name="status">'; else echo '<input type="checkbox" name="status">'; ?></td>
 </tr> 
 <tr>
   <td valign="top" width="150px">Акционный</td>
   <td valign="top" align="left"><? if($row[16]==1) echo '<input type="checkbox" checked name="action">'; else echo '<input type="checkbox" name="action">'; ?></td>
 </tr>
 <tr>
   <td valign="top" colspan="2">Описание
   <textarea id="textdesc" name="textdesc"><? echo str_replace('="./img','="../img',$row[7]); ?></textarea>
			<script type="text/javascript">
	CKEDITOR.replace('textdesc', {
	filebrowserBrowseUrl : './ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : './ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : './ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : 
 	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
	filebrowserImageUploadUrl : 
	   './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
	filebrowserFlashUploadUrl : './ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
			</script></td>
 </tr>
 </table>
 </fieldset><br />
  <div align="center">
<input type="submit" name="<? echo $level; ?>" value="Сохранить">&nbsp;&nbsp;<? if($_SESSION['lvl']==0) {?><input type="submit" name="DEL_SEO" value="Удалить">&nbsp;&nbsp;<? } ?><input type="submit" name="Cancel" value="Отмена"></div>
<? if($_SESSION['lvl']<2)
{
?>
 <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px;width:99%"><legend>&nbsp;SEO-оптимизация&nbsp;</legend>
 <table cellpadding="0" cellspacing="6" border="0" width="100%">
 <tr>
   <td valign="top" width="150px">&lt;Title&gt;</td>
   <td valign="top" align="left"><textarea name="title" cols="100" rows="3" ><? echo stripslashes($row[11]);?></textarea></td>
 </tr>
 <tr>
   <td valign="top">&lt;Description&gt;</td>
   <td valign="top" align="left"><textarea name="description" cols="100" rows="3" ><? echo stripslashes($row[12]);?></textarea></td>
 </tr>
 <tr>
   <td valign="top">&lt;Keyword&gt;</td>
   <td valign="top" align="left"><textarea name="keyword" cols="100" rows="3" ><? echo stripslashes($row[13]);?></textarea></td>
 </tr>
 </table>
 </fieldset><br />
 <div align="center">
<input type="submit" name="<? echo $level; ?>" value="Сохранить">&nbsp;&nbsp;<? if($_SESSION['lvl']==0) {?><input type="submit" name="DEL_SEO" value="Удалить">&nbsp;&nbsp;<? } ?><input type="submit" name="Cancel" value="Отмена"></div>
<?
}
		}
	}
	else
	{
?>
<table cellpadding="0" cellspacing="5" border="0">
<tr>
 <td nowrap style="padding-right:5px;"; valign="top">
 	<a class="<? if(isset($_GET['category'])) echo 'list';
		 else echo 'marked';?>" href="<? echo $url_page ?>">Все категории</a><br><br>
<?php
		$sql="SELECT id, category_name, count_product, active_p FROM categories ORDER BY category_name ASC";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
		while($row=mysql_fetch_row($res))
		{
			 echo '<a class="';
			 if($_GET['category']==$row[0]) echo 'marked';
			 else echo 'list';
			 echo '" href="'.$url_page.'&category='.$row[0].'">'.$row[1].' ('.$row[2].')('.$row[3].')</a><br>';
		}
?></td>
 <td valign="top" width="100%">
 
<?
	 if($_SESSION['lvl']==0||$_SESSION['lvl']==2) {?>
     <div align="center"><a class="list" href="<? if($url_cat) echo $url_cat; else echo $url_page; ?>&add=1">Добавить</a></div><br><? } 
	 if($_GET['category']&&is_numeric($_GET['category']))
 	 {
		$sql="SELECT * FROM product WHERE category='".$_GET['category']."'";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
		$num_of_row=mysql_num_rows($res);
		
		if(!is_numeric($_GET['numberpage'])||0>=$_GET['numberpage']||$_GET['numberpage']>ceil($num_of_row/LIMIT_PAGE_PRODUCT)) { $numberpage=1; $_GET['numberpage']=1;}
		else $numberpage=$_GET['numberpage'];

		$sql="SELECT * FROM product WHERE category='".$_GET['category']."' ORDER BY id ASC LIMIT ".($numberpage-1)*LIMIT_PAGE_PRODUCT.",".LIMIT_PAGE_PRODUCT;
		$res=mysql_query($sql,$db);
		while($row=mysql_fetch_row($res))
		{
			if(!$f) 
			{
?><table cellpadding="5" cellspacing="2" border="0" width="100%" >
<tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
<td width="300">Название</td><td>Описание</td><td>Цена</td><td>Наша цена</td><td>Бонусы</td><td>Логотип</td><td>Дата окончания</td><td>Статус</td><td>Title</td><td>Keyword</td><td>Description</td>
</tr> <?
			$f=1;
			}
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;" onclick="top.location.href='<? echo $url_page; ?>&category=<? echo $row[2]; ?>&edit=<? echo $row[0]; ?>'">
<td><? echo stripslashes($row[1]);?></td>
<td align="center"><? if(!empty($row[7])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? echo $row[3];?></td>
<td align="center"><? echo $row[4];?></td>
<td align="center"><? echo $row[5];?></td>
<td align="center"><? if(!empty($row[6])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? echo $row[9];?></td>
<td align="center"><? if($row[10]) echo 'вкл'; else echo 'ВЫКЛ';?></td>
<td align="center"><? if(!empty($row[11])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? if(!empty($row[12])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? if(!empty($row[13])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
</tr>
<?
		}
?>
</table>
<?	 
		echo '<br><hr><div align="center">';
		echo_page_number($num_of_row, LIMIT_PAGE_PRODUCT,'list','./'.$url_cat,'&nbsp;');
		echo '</div>';
	 }
 	else
	 {
?>
<table cellpadding="5" cellspacing="2" border="0" width="100%" >
<tr bgcolor="#D3DCE3" style="color:#0000FF" align="center">
<td width="300">Название</td><td>Описание</td><td>Цена</td><td>Наша цена</td><td>Бонусы</td><td>Логотип</td><td>Дата окончания</td><td>Статус</td><td>Title</td><td>Keyword</td><td>Description</td>
</tr> 
<?
		$sql="SELECT * FROM product";
		$res=mysql_query($sql,$db) or die('нет связи с БД');
		$num_of_row=mysql_num_rows($res);
		
		if(!is_numeric($_GET['numberpage'])||0>=$_GET['numberpage']||$_GET['numberpage']>ceil($num_of_row/LIMIT_PAGE_PRODUCT)) { $numberpage=1; $_GET['numberpage']=1;}
		else $numberpage=$_GET['numberpage'];

		$sql="SELECT * FROM product ORDER BY id ASC  LIMIT ".($numberpage-1)*LIMIT_PAGE_PRODUCT.",".LIMIT_PAGE_PRODUCT;
		$res=mysql_query($sql,$db);
		while($row=mysql_fetch_row($res))
		{
?>
<tr class="<? if($odd) {$odd=0; echo "even";}
else { $odd=1; echo "odd";}?>" style="cursor:pointer;" onclick="top.location.href='<? echo $url_page; ?>&category=<? echo $row[2]; ?>&edit=<? echo $row[0]; ?>'">
<td><? echo stripslashes($row[1]);?></td>
<td align="center"><? if(!empty($row[7])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? echo $row[3];?></td>
<td align="center"><? echo $row[4];?></td>
<td align="center"><? echo $row[5];?></td>
<td align="center"><? if(!empty($row[6])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? echo $row[9];?></td>
<td align="center"><? if($row[10]) echo 'вкл'; else echo 'ВЫКЛ';?></td>
<td align="center"><? if(!empty($row[11])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? if(!empty($row[12])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
<td align="center"><? if(!empty($row[13])) echo '<img src="img/s_okay.png">'; else echo '<img src="img/b_drop.png">';?></td>
</tr>
<?
		}
?>
</table>
<? 
		echo '<br><hr><div align="center">';
		echo_page_number($num_of_row, LIMIT_PAGE_PRODUCT,'list','./'.$url_page,'&nbsp;');
		echo '</div>';
 }
?></td>
</tr>
</table>
<?
}
?>