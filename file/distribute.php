<div class="vender_main">Как получить дисконтную карточку free-B</div>
<div style="margin: 20px 25px 0 25px; color:#666" align="justify">
<?
	$sql = "SELECT `description` FROM page WHERE id=".$_GET['page'];
	$query = mysql_query($sql);
	$row = mysql_fetch_row($query);
	echo $row[0];
?>
<!--<p>
	<img alt="" src="/img/images/freebcard.jpg" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; float: left; width: 226px; height: 147px; " /></p>
<p>
	<br />
	Для получения карточки, Вам необходимо прийти в магазин партнер, который распространяет дисконтные карточки free-B или купить карту у дилера. Вам необходимо заполнить анкету участника free-B на месте, а также ответить на опрос (в этом случае Вы получите бесплатный подарок)<br />
	<br />
  <br />
  <br />
</p>
<p>
	&nbsp;Дисконтные карты free-B продаются в следующих местах.</p>
<p>&nbsp;</p>
<?
	//$sql="SELECT name, adress, id, category FROM vender WHERE distribution='1' AND active='1'";
	//$res=mysql_query($sql);
	//while($row=mysql_fetch_row($res))
	//{
?>
<div style="line-height:24px;"><a class="product_inside_header" href="/page/4/category/<? //echo $row[3]; ?>/partner/<? //echo $row[2]; ?>"><? //echo $row[0];?></a> по адресу
<? //if(strpos($row[1],'<br>')) echo substr($row[1],0,strpos($row[1],'<br>')); 
   //else echo $row[1]; 
?></div><div></div> -->
<?
	//}	
?>
<br>
<br>
