<? include('../config.php'); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

</head>
<body topmargin="0" leftmargin="0">
<style>
.even {
background: #eee;
}

.odd {
background: #fff;
}

td a
{
	color:#fff; font-size:15px; font-weight:bold;
}

th a
{
	color:#FFF; font-size:15px; font-weight:bold;
}

tr.odd:hover, tr.even:hover {
  background: #f3bd48; /* Oaao oiia i?e iaaaaaiee */
  color: #fff; /* Oaao oaenoa i?e iaaaaaiee */
}

</style>
<div style="widht:100%">
 <div style="float:left; width:15%; background-color:#efefef;"><p align="center">Statistics v1.1 :)</p><p></p>
<?
	//echo floor(265*0.75)/100;
	$one_fB=50;
	$menu = 0;
	$menu=array ('1'=>array ('% прибыли','statv.php'),array ('Держатели карт','statm.php'),array ('Контрагенты','statp.php'),array ('Карточки покупателей', 'statc.php'));
	foreach($menu as $key=>$val)
	{
		echo '<p align="left"><a href="?stat='.$key.'">'.$val[0].'</a></p>';
	}
?>
 </div>
 <div style="float:left; width:85%;">
 	<div style="margin-left:15px; margin-top: 10px;">
<?
	if($_GET['stat']) include('./file/'.$menu[$_GET['stat']][1]);
?>
    </div>
 </div>
 <DIV STYLE="clear:left;"></DIV>
</div>
</body>
</html>