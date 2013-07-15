<style>
.freeb1
{
	width:237px;
	height:57px;	
	display:block;
	background:url(/image/freeb2.gif) no-repeat;
}

.freeb1:hover
{
	background-position: 0 -57px;
}

.freeb2
{
	width:237px;
	height:57px;	
	display:block;
	background:url(/image/freeb1.gif) no-repeat;
}

.freeb2:hover
{
	background-position: 0 -57px;
}

.freeb3
{
	width:237px;
	height:57px;	
	display:block;
	background:url(/image/freeb4.gif) no-repeat;
}

.freeb3:hover
{
	background-position: 0 -57px;
}

.freeb4
{
	width:237px;
	height:57px;	
	display:block;
	background:url(/image/freeb5.gif) no-repeat;
}

.freeb4:hover
{
	background-position: 0 -57px;
}

.freeb5
{
	width:237px;
	height:57px;	
	display:block;
	background:url(/image/freeb3.gif) no-repeat;
}

.freeb5:hover
{
	background-position: 0 -57px;
}

.list_partner_main
{
	display: block;
	float:left;
	text-decoration:none; 
	width:110px; 
	padding:15px 10px 10px 10px;
	margin:10px 3px 10px 3px;
	height:120px;
}

.list_partner_main:hover
{
	background:#e3e7ea;
}

</style>

<div class="vender_main">Единая дисконтная система free-B</div>

<div style="height:370px; width: 383px; margin-top: 60px; margin-bottom: 120px;" align="center">
  <div style="background:url(/image/main_logo.gif) no-repeat; height:370px; width:383px; position:absolute; margin-left:150px; margin-top:16px;">
   <div style="float:left; z-index:2; width:237px; height:57px; margin-left:-100px; margin-top: -20px;"><a href="/page/3" class="freeb1"></a>
   </div>
   <div style="float:right; z-index:2; margin-top: -45px; margin-right: -180px; width:237px; height:57px;"><a href="/page/4" class="freeb2"></a></div>
   <div style="clear:both;"></div>
   <div style="float:left; z-index:2; margin-top: 233px; margin-left: -125px;"><a href="/page/8" class="freeb3"></a></div>
   <div style="float:right; z-index:2; margin-top: 245px; margin-right: -155px;"><a href="/page/5" class="freeb5"></a></div>
   <div style="clear:both;"></div>
   <div style="float:left; z-index:2; margin-left: 80px; margin-top: 30px;"><a href="/page/23" class="freeb4"></a></div>
   <div style="clear:left;"></div>
  </div>
</div>
<div style="margin:25px 25px 50px 25px; color:#666;">
<div align="center" style="border-bottom:#cdcdcd 1px solid; padding-bottom:10px;"><b>Последние подключенные 10 партнеров </b></div>
	<div align="center" style="margin-top:10px;">
<?
	$sql="SELECT id, category, mini_logo, discount FROM vender WHERE logo_pos>0 AND mini_logo!='' AND active!=0 ORDER BY id DESC LIMIT 10";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{
			if($row[2])
			{
?>
<a href="/page/<? echo NUMBER_PAGE_VENDER;?>/category/<? echo $row[1];?>/partner/<? echo $row[0];?>" class="list_partner_main">
<img  src="<?  echo DIR_LOGO_OURPARTNER.'/'.$row[2];?>" width="90" border="0"/>
<div style="width:90px; color:#3b1e44; margin-top:10px;" align="center">Скидка <b style="color:#f00;"><? echo $row[3];?>%</b></div>
</a>
<?
			}
	}	
?>
	</div>
</div>