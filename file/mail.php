<div style="margin:20px;">
<?
	$sql="SELECT * FROM member_mail WHERE id_user='".$_SESSION['id_user']."'";
	$res=mysql_query($sql,$db);
	$num_of_row=mysql_num_rows($res);

	if(!is_numeric($_GET['numberpage'])||0>=$_GET['numberpage']||$_GET['numberpage']>ceil($num_of_row/LIMIT_PAGE_MAIL)) $numberpage=1;
	else $numberpage=$_GET['numberpage'];

	$sql="SELECT * FROM member_history WHERE id_user='".$_SESSION['id_user']."' AND id='".$status."' ORDER BY date DESC LIMIT ".($numberpage-1)*LIMIT_PAGE_HISTORY.",".LIMIT_PAGE_HISTORY;
	$res=mysql_query($sql,$db);

	$sql="SELECT * FROM member_mail WHERE id_user='".$_SESSION['id_user']."' ORDER BY datemsg DESC LIMIT ".($numberpage-1)*LIMIT_PAGE_MAIL.",".LIMIT_PAGE_MAIL;
	$res=mysql_query($sql,$db);
	$res=mysql_query($sql,$db) or die('нет связи с БД');
	while($row=mysql_fetch_row($res))
	{
?>
  <div style="border-bottom:#dee5e9 1px solid; margin-top:10px; padding-bottom:10px; color:#971d81">
	<div style="float:left; width: 80px;"><? echo date("d.m.Y",strtotime($row[3]));?></div>
    <div style="float:left; color:#666;"><? echo $row[1];?></div>
    <div style="clear:left"></div>
  </div>
<?
	}
?>
</div>
<div style="height:35px;"></div>
<?
	echo_page_number($num_of_row, LIMIT_PAGE_MAIL,'./'.$url_page.'/cabinet/'.$_GET['cabinet']);
?>