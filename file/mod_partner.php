<style>

a.prev1, a.next1 {
	background:url(/image/up.png) no-repeat;
	width: 28px;
	height: 28px;
	display: block;
	margin:4px 3px 0px 3px;
	background-position:-30px -30px;
	border-
} 

a.prev1:hover
{
	background-position:0 -30px;
}

a.next1:hover
{
	background-position:0px 0px;	
}

a.next1
{
	background-position:-30px 0px;
}

</style>

<div align="center"><a id="prev1" class="prev1" href="#"></a></div>
	<div id="partner_scroll" align="center">
<?  
	$result=mysql_query("SELECT id, category, mini_logo, discount FROM vender WHERE logo_pos>0 AND mini_logo!='' AND active='1' ORDER BY logo_pos ASC",$db);
	while($row=mysql_fetch_row($result))
	{
			if($row[2])
			{
?>
<!-- <div class="ginginberg" onclick="window.location='/page/<? //echo NUMBER_PAGE_VENDER;?>/category/<? echo $row[1];
?>/partner/<? //echo $row[0];?>'" style="cursor:pointer;">
 <div style="text-align: center; margin-left:12px; margin-right:12px; padding:15px 0px 15px 0px;<?
//  if($f_partner) echo 'border-top:#dcdfe1 1px solid;"'; else $f_partner=1;?>">
  <img src="<? // echo DIR_LOGO_OURPARTNER.'/'.$row[2];?>" border="0" width="90">
  <div style="color:#3b1e44; margin-top:10px;">Скидка <b style="color:#f00;"><? // echo $row[3];?>%</b></div>
 </div>
</div> -->
<a href="/page/<? echo NUMBER_PAGE_VENDER;?>/category/<? echo $row[1];?>/partner/<? echo $row[0];?>" class="ginginberg">
<img  src="<?  echo DIR_LOGO_OURPARTNER.'/'.$row[2];?>" width="90" border="0"/>
<div style="width:90px; color:#3b1e44; margin-top:10px;" align="center">Скидка <b style="color:#f00;"><? echo $row[3];?>%</b></div>
</a>
<?
			}
	}
?>
	</div>
	<div align="center"><a id="next1" class="next1" href="#"></a></div>



