<div class="menu_vp1" style="float:left">
 <ul> 
   <li>
   <a class="menu_vp_a" <? if($_GET['page']==NUMBER_PAGE_VENDER) echo 'style="background:url(/image/choise.png) no-repeat;	background-position: 0 9px;"';?> href="/page/<? echo NUMBER_PAGE_VENDER;?>">
<div>
    <div style="float:left; margin-left:5px;"><img src="<? echo DIR_MAIN_IMAGES; ?>/choise_down.png" style="margin-right:10px; margin-top:6px;" border="0"></div>
    <div style="float:left; line-height:18px;">
   	<div style="font:Verdana; font-size:16px; font-weight:bold; color:#971d81;">Где получить скидки?</div>
    <div style="font:Arial; font-size:11px; color:#971d81;">Все партнеры</div>
   </div>
   <div style="clear:left;"></div>
</div>
</a>
  <!--[if lte IE 6]>
  <a href="">Раздел 1
  <table><tr><td>
  <![endif]-->
     <ul>
      <table cellpadding="0" cellspacing="0" border="0" width="560">
<tr>
 <td width="2" style="background:url(image/product_list_left.png)"></td>
 <td style="padding:15px; background-color:#e2e6ea;">
<?
	$sql="SELECT id, category_name FROM categories WHERE active_v>0 ORDER BY category_name ASC";
	$res=mysql_query($sql,$db) or die('нет связи с БД');
	$num_rows=mysql_num_rows($res);
	$asd=ceil($num_rows/2);
	$ccc=0;
	echo '<div style="float:left;margin-right:25px;">';
	while($row=mysql_fetch_row($res))
	{
		if($ccc==$asd) 
		{
			echo '</div><div style="float:left;margin-right:25px;">';
			$ccc=0;
		}
		echo '<a class="menu_list_pv" href="/page/'.NUMBER_PAGE_VENDER.'/category/'.$row[0].'"><img src="'.DIR_MAIN_IMAGES.'/curs.png" style="margin-right:8px; margin-top:8px;" align="left" border="0">'.$row[1].'</a><br>';
		$ccc+=1;
	}
	echo '</div><div style="clear:both"></div>';
?>
 </td>
 <td width="2" style="background:url(image/product_list_right.png)"></td>
<tr>
<tr>
 <td width="2" height="5" style="background:url(image/product_list_lc.png)"></td>
 <td height="5" style="background:url(image/product_list_down.png)"></td>
 <td width="2" height="5" style="background:url(image/product_list_rc.png)"></td>
</tr>
</table>
     </ul>
 <!--[if lte IE 6]>
 </td></tr></table>
</a>
 <![endif]--> 
   </li>
 </ul> 
</div>

<div class="menu_vp" style="float:left; margin-left:10px;">
 <ul> 
   <li>
      <a class="menu_vp_a" style="padding-left:5px;<? if($_GET['page']==NUMBER_PAGE_PRODUCT) echo ';background:url(/image/choise.png) no-repeat;	background-position: 0 9px;"'; else echo '"';?> href="/page/<? echo NUMBER_PAGE_PRODUCT;?>">
<div>
   <div style="float:left;"><img src="<? echo DIR_MAIN_IMAGES; ?>/choise_down.png" style="margin-right:10px; margin-top:6px;" border="0"></div>
   <div style="float:left; line-height:18px;">
   	<div style="font:Verdana; font-size:16px; font-weight:bold; color:#971d81;">Бонусные товары</div>
    <div style="font:Arial; font-size:11px; color:#971d81;">Все товары</div>
   </div>
   <div style="clear:left;"></div>
</div>
</a>
 <!--[if lte IE 6]>
  <a href="">Раздел 1
  <table><tr><td>
  <![endif]-->
     <ul>
      <table cellpadding="0" cellspacing="0" border="0" width="560">
<tr>
 <td width="2" style="background:url(/image/product_list_left.png)"></td>
 <td style="padding:15px; background-color:#e2e6ea;">
<?
	$sql="SELECT id, category_name FROM categories WHERE active_p>0 ORDER BY category_name ASC";
	$res=mysql_query($sql,$db) or die('нет связи с БД');
	$num_rows=mysql_num_rows($res);
	$asd=ceil($num_rows/2);
	$ccc=0;
	echo '<div style="float:left;margin-right:25px;">';
	while($row=mysql_fetch_row($res))
	{
		if($ccc==$asd) 
		{
			echo '</div><div style="float:left;margin-right:25px;">';
			$ccc=0;
		}
		echo '<a class="menu_list_pv" href="/page/'.NUMBER_PAGE_PRODUCT.'/category/'.$row[0].'"><img src="'.DIR_MAIN_IMAGES.'/curs.png" style="margin-right:8px; margin-top:8px;" align="left" border="0">'.$row[1].'</a><br>';
		$ccc+=1;
	}
	echo '</div><div style="clear:both"></div>';
?>
 </td>
 <td width="2" style="background:url(/image/product_list_right.png)"></td>
<tr>
<tr>
 <td width="2" height="5" style="background:url(/image/product_list_lc.png)"></td>
 <td height="5" style="background:url(/image/product_list_down.png)"></td>
 <td width="2" height="5" style="background:url(/image/product_list_rc.png)"></td>
</tr>
</table>
     </ul>
 <!--[if lte IE 6]>
 </td></tr></table>
</a>
 <![endif]--> 
   </li>
 </ul> 
</div>

<div style="float:right; margin-right: 16%;">
<div>
   <div style="float:left; "><img width="70px" src="<? echo DIR_MAIN_IMAGES; ?>/stop.png" style="margin-right:5px;" border="0"></div>
   <div style="float:left; line-height:18px;">
   	<div style="margin-top:17%; width: 100px;" ><a style="text-decoration: none; font:Verdana; font-size:16px; font-weight:bold; color:#971d81; text-align: center;" href="/page/26">Недобросовестные партнеры</a></div>
   </div>
   <div style="clear:left;"></div>
</div>
</div>
<div style="clear:both;"></div>