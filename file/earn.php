<style>
.choise_partner:hover
{
	background-color:#ededed;
}
</style>

<div class="vender_main">Заработай с free-B</div>
<div style="margin: 20px 25px 0 25px; color:#666" align="justify">
 <img alt="" src="/img/images/earn-money.jpg" align="left" style="width: 150px; height: 111px; padding:0px 10px 10px 0px"/>
&nbsp;&nbsp;&nbsp;&nbsp;Единая дисконтная система free-B работает
 по схеме cash back(возврат реальных денег). Помимо скидок, и начисления fB баллов, система выплачивает вознаграждения за подключение Ваших друзей к системе на постоянной основе.
 Привлекая друзей в систему(рефералов) Вы зарабатываете реальные деньги с любой их покупки
 (если покупка была совершена в магазине партнеров, и была использована дисконтная карта). 
 Список процентов от покупок указан ниже.
   Чтобы зарабатывать с привлеченных людей, Вам необходимо  <a class="fordump" href="/page/24">стать нашим дилером</a>.
Cистема с каждым днем обретает новых партнеров, соответственно Ваш заработок всегда будет увеличиваться. 
   Список приглашенных друзей, историю их покупок и сколько Вам начислено денег, Вы можете посмотреть в Вашем личном кабинете.
Вывод личных средств из системы осуществляется банковским переводом.
<br><br>
<p align="center">Таблица Ваших денежных вознаграждений (% от покупки Ваших рефералов)</p><br>
</div>
<?
	$sql="SELECT name, referal, id , category FROM vender WHERE active=1 AND referal>0";
	$res=mysql_query($sql,$db);
	$num_row=mysql_num_rows($res);
	$col=ceil($num_row/2);
	$ccc=1;
?>
<div align="center" style="width:700px; margin: 0px 25px;">
 <div style="float:left;">
<?
	while($row=mysql_fetch_row($res))
	{	
?>
    <div style="width:315px; padding:5px;" class="choise_partner">
	  <div style="float:left"><a class="product_inside_header" href="/page/4/category/<? echo $row[3]; ?>/partner/<? echo $row[2]; ?>"><? echo stripslashes($row[0]); ?></a></div>
	  <div style="float:right"><? echo $row[1]; ?>%</div>
	  <div style="clear:both"></div>
    </div>
<?
		if($ccc==$col) 
		{
			echo '</div><div style="float:left; margin-left: 30px;">';
			$ccc=1;
		}
		$ccc++;
	}
?>
 </div>
 <div style="clear:left;"></div>
</div>
<div style="height:25px;" align="left">&nbsp;</div>