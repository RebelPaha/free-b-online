<div style="background: url(<? echo DIR_MAIN_IMAGES;?>/pc_dline.png) repeat-x; width:740px;">
<? 
if(!isset($_GET['chooise'])) $_GET['chooise']=0;
$prod_menu=array (
array ('Все товары','/page/'.NUMBER_PAGE_PRODUCT),
array ('Акционные товары','/page/'.NUMBER_PAGE_PRODUCT.'/chooise/1'),
array ('Розыгрыши','/page/'.NUMBER_PAGE_STOCK),
array ('История розыгрышей','/page/'.NUMBER_PAGE_HISTOCK));

foreach($prod_menu as $key=>$value)
{
	if($key==2)
    {
    ?>
  <div style="background: url(<? echo DIR_MAIN_IMAGES;?>/pc_choise_l.png) no-repeat; width:12px; height:42px; float:left;"></div>
  <div style="float:left;background: url(<? echo DIR_MAIN_IMAGES;?>/pc_choise_bg.png) repeat-x; height:42px; line-height:42px; padding-left:6px; padding-right:11px; font-weight:bold; text-transform:uppercase;"><a href="<? echo $value[1]?>" class="pc_menu_link" style=" color:#971d81;"><? echo $value[0]?></a></div>
  <div style="float:left;background: url(<? echo DIR_MAIN_IMAGES;?>/pc_choise_r.png) no-repeat; width:8px; height:42px; float:left;"></div>
	<?
	} else
	{
	?>
  <div style="float:left; height:42px; line-height:42px; padding-left:20px; padding-right:20px;"><a href="<? echo $value[1]?>" class="pc_menu_link"><? echo $value[0]?></a></div>
<?
	}
}
?>
  <div style="clear:left"></div>
</div>

<?
	if($_POST['join_game']&&is_numeric($_GET['action']))
	{
		$sql="SELECT balls,name_action FROM action WHERE id='".$_GET['action']."' AND status='1'";
		$res=mysql_query($sql,$db);
		if($row=mysql_fetch_row($res)) 
		    if($_SESSION['balls']>=$row[0])
			{
				$sql="INSERT INTO join_game VALUES('".$_GET['action']."','".$_SESSION['id_user']."')";
				$res=mysql_query($sql,$db);
				$sql="INSERT INTO member_history VALUES('1','".$_SESSION['id_user']."','','".$row[1]."','".date("Y-m-d H:i:s")."','".$row[0]."','1','".$row[0]."')";
				$res=mysql_query($sql,$db);
				$_SESSION['all_product']+=$row[0];
				$_SESSION['balls']-=$row[0];
			}
		$sql="UPDATE member SET balls='".$_SESSION['balls']."', all_product='".$_SESSION['all_product']."' WHERE id='".$_SESSION['id_user']."'";
		$res=mysql_query($sql,$db) or die('Не получилось');
		// Обновление данных
		echo '<script language="javascript">
	top.location.href="/'.$_SERVER['argv'][0].'";
	</script>';
	}
	
	if(is_numeric($_GET['action'])&&$_GET['action']>0)
	{
		$sql="SELECT id, name_action, event_date, text, image, balls FROM action WHERE status='1' AND id='".$_GET['action']."'";
		$res=mysql_query($sql,$db);
		if($row=mysql_fetch_row($res))
		{
			$sql1="SELECT * FROM join_game WHERE id_user='".$_SESSION['id_user']."' AND id_action='".$_GET['action']."'";
			$res1=mysql_query($sql1,$db);
			$in_join=0;
			if($row1=mysql_fetch_row($res1))
			{
				if($row1[0]==$_GET['action']) $in_join=1;
			}
?>
<div class="stock_header2"><? echo $row[1];?></div>
<div class="stock_leb">
  <div class="stock_logo2"><img src="<? echo DIR_STOCK_IMAGE.'/'.$row[4]; ?>" width="465" height="340"></div>
  <div class="stock_event">
  		<div class="stock_event2"><img src="<? echo DIR_MAIN_IMAGES; ?>/clock.png" align="left"/>Дата проведения<br />
            <b><? echo date("d.m.y H:i",strtotime($row[2]));?></b>
        </div>
        <div class="stock_text2">Для участия необходимо</div>
        <div class="stock_balls2"><? echo $row[5];?> баллов</div>
        <div class="stock_notify"><? 
		if(empty($_SESSION['id_user'])) echo '<img src="'.DIR_MAIN_IMAGES.'/warning.png" align="left">Для того, чтобы принять участие, нужно быть зарегистрированным пользователем. <a href="/page/'.PAGE_REGISTRATION.'">ЗАРЕГИСТРИРУЙТЕСЬ</a>';
		elseif($_SESSION['balls']<$row[5]) echo '<img src="'.DIR_MAIN_IMAGES.'/warning.png" align="left">Недостаточно баллов для участия.';
		elseif($in_join) echo '<img src="'.DIR_MAIN_IMAGES.'/warning.png" align="left">Вы уже принимаете участие в розыгрыше';
		else echo '<form method="post"><input type="submit" value="&nbsp;" name="join_game" class="stock_notify_btn"></form>'; ?>
        </div>
  </div>  
</div>		
<div style="clear:left;"></div>	
<div class="stock_desc">Описание приза</div>
<div class="stock_desc2"><? echo $row[3];?></div>
<?	
		}
	}
	else
	{
		echo '<div class="stock_description">'.$TXT_DESCRIPTION.'</div>';
 		$sql="SELECT * FROM action WHERE status='1'";
		$res=mysql_query($sql,$db);
		$num_of_row=mysql_num_rows($res);
		if(!is_numeric($_GET['numberpage'])||0>=$_GET['numberpage']||$_GET['numberpage']>ceil($num_of_row/LIMIT_PAGE_STOCK)) $numberpage=1;
		else $numberpage=$_GET['numberpage'];
		$sql="SELECT id, name_action, event_date, mini_text, image, balls FROM action WHERE status='1' ORDER BY event_date DESC LIMIT ".($numberpage-1)*LIMIT_PAGE_STOCK.",".LIMIT_PAGE_STOCK;
		$res=mysql_query($sql,$db);
		// echo $num_of_row;
		while($row=mysql_fetch_row($res))
		{			
?>
<div class="stock">
	<div class="stock_logo"><img src="<? echo DIR_STOCK_IMAGE.'/sm_'.$row[4]; ?>" width="240" height="175"></div>
	<div class="stock_right">
    	<div class="stock_header"><a class="stock_header" href="<? echo $url_page;?>/action/<? echo $row[0]; ?>"><? echo $row[1];?></a></div>
        <div class="stock_minitext"><? echo $row[3];?></div>
        <div class="stock_date">
        	<img src="<? echo DIR_MAIN_IMAGES; ?>/clock.png" align="left"/>Дата проведения<br />
            <b><? echo date("d.m.y H:i",strtotime($row[2]));?></b>
            <div style="margin-top:10px;"><a href="<? echo $url_page;?>/action/<? echo $row[0]; ?>" class="detail_btn_a"></a></div>
		</div>
        <div class="stock_need">Для участия необходимо</div>
        <div class="stock_balls"><? echo $row[5];?> баллов</div>
        <div style="clear:left;"></div>
    </div>
    <div style="clear:left;"></div>
</div>
<?
		}
		// Вывод номерации страниц
		echo_page_number($num_of_row, LIMIT_PAGE_STOCK,'./'.$url_page);
	}	
?>