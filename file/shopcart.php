<?
if($_GET['nobuy']==1)
{
?>
<div class="vender_main">Некоторые подарки уже закончились.</div>
<table cellpadding="10" cellspacing="1" border="0" bgcolor="#dcdfe1" width="700" align="center" style="margin-top:20px;">
<tr bgcolor="#971d81" style="color:#fff; font-weight: bold;">
 <td>Название</td><td align="center">Стоимость, баллов</td><td align="center">Количество</td>
</tr><?
// Вывод товаров
	foreach($_SESSION['trash_tmp'] as $id=>$value)
	{
		?>
<tr bgcolor="#fff" style="color:#666666;">
 <td><a href="<? echo $value[2]; ?>" class="shop_link"><? echo $value[1];?></a></td>
 <td align="center"><? echo $value[3]?></td> 
 <td align="center"><? echo $value[0]?></td>
</tr>     
        <?
		$summa+=$value[0]*$value[3];
	}
?>
</table>
<div class="shop_summa" style="line-height: 42px;">Общая сумма = <span style="font-size:16px;"><? echo $summa; ?></span> баллов</div>
<div style="clear:left;height:35px;"></div>
<?
}
elseif($_POST['order'])
{
	if($_SESSION['summa']<=$_SESSION['balls'])
	{
		unset($_SESSION['trash_tmp']);
		foreach($_SESSION['trash'] as $id=>$value)
		{
			$sql="SELECT purchased, count_prod FROM product WHERE id='".$id."'";
			$res=mysql_query($sql,$db) or die(mysql_error());
			if($row=mysql_fetch_row($res)) 
			{
                                                                           
				if($row[1]!=0&&$value[0]<=$row[1])
				{
                                
					$sql1="UPDATE product SET ";
					if($row[1]>0) 
					{
						$count_prod=$row[1]-$value[0];
						$sql1.="count_prod='".$count_prod."',";
					}
					$purchase=$row[0]+$value[0];
					$sql1.="purchased='".$purchase."' WHERE id='".$id."'";
					$res1=mysql_query($sql1,$db) or die('не возможно добавить в корзину. Внутрення ошибка'); 
                                                                                            // -- ОБЯЗАТЕЛЬНО (!) всегда указывать, в какие колонки таблицы мы вносим данные. Из-за этого может быть ошибка --
					$sql5="INSERT INTO `orders` (`dateorder`,`id_user`,`id_product`,`number`,`balls`,`link_url`,`status`,`message`,`id_vender`) VALUES(NOW(),'".$_SESSION['id_user']."','".$id."','".$value[0]."','".$value[3]."','".$value[2]."','0','','".$value[4]."')";
                                                                         $res4=mysql_query($sql5,$db) or die(mysql_error());			
				}
				else  /// Тут нужно вставить что выводить если товар закончился...
				{
					$_SESSION['summa']-=$value[3]*$value[0];	
					$_SESSION['trash_tmp'][$id]=array($value[0],$value[1],$value[2],$value[3]);
					//die();		
				}
			}
		}
			
		$_SESSION['balls']-=$_SESSION['summa'];
		$_SESSION['all_product']+=$_SESSION['summa'];
		// уменьшить кол-во балов пользователя
		$sql="UPDATE member SET balls='".$_SESSION['balls']."', all_product='".$_SESSION['all_product']."' WHERE id='".$_SESSION['id_user']."'";
		$res=mysql_query($sql,$db) or die('Не получилось');			
		// запись в таблицу заказов
		// $date=date();
		$_SESSION['trash'] = array();
		$_SESSION['summa'] = 0;
	}
	if($_SESSION['trash_tmp'])
		echo '<script language="javascript">
		top.location.href="/page/'.$_GET['page'].'/nobuy/1";
		</script>';
	else
	{	
		$_SESSION['changed']=6;
		echo '<script language="javascript">
		top.location.href="/page/'.CHANGED_PAGE.'";
		</script>';
	}
}
// Если добавляется товар из магазина
elseif(!empty($_GET['id'])&&is_numeric($_GET['id'])&&$_GET['id']>0)
{
	$sql="SELECT id, name, category, balls, id_vender FROM product WHERE id='".$_GET['id']."'";
	$res=mysql_query($sql,$db);
	if($row=mysql_fetch_row($res)) 
	{
		$_SESSION['trash'][$row[0]]=array (($_SESSION['trash'][$row[0]][0]+1),$row[1],'/page/'.NUMBER_PAGE_PRODUCT.'/category/'.$row[2].'/product/'.$row[0],$row[3],$row[4]);
		$_SESSION['summa']+=$row[3];
		$_SESSION['count_product']+=1;
	}
	echo '<script language="javascript">
		top.location.href="/page/'.$_GET['page'].'";
		</script>';
}
// если удаляется магазин
elseif(!empty($_GET['del'])&&is_numeric($_GET['del'])&&$_GET['del']>0)
{
	$_SESSION['summa']-=$_SESSION['trash'][$_GET['del']][3];
	if($_SESSION['trash'][$_GET['del']][0]>1) 
	{
		$_SESSION['trash'][$_GET['del']][0]-=1;
		$_SESSION['count_product']-=1;
	}
	else 
	{
		unset($_SESSION['trash'][$_GET['del']]);
		$_SESSION['count_product']=0;
	}
	echo '<script language="javascript">
		top.location.href="/page/'.$_GET['page'].'";
		</script>';
}
// Вывод заказа
else
{
//	print_r($_SESSION['trash']);
?>

<div class="vender_main">Корзина</div>
<table cellpadding="10" cellspacing="1" border="0" bgcolor="#dcdfe1" width="700" align="center" style="margin-top:20px;">
<tr bgcolor="#971d81" style="color:#fff; font-weight: bold;">
 <td>Название</td><td align="center">Стоимость, баллов</td><td align="center">Количество</td><td align="center"></td>
</tr><?
// Вывод товаров
	foreach($_SESSION['trash'] as $id=>$value)
	{
		?>
<tr bgcolor="#fff" style="color:#666666;">
 <td><a href="<? echo $value[2]; ?>" class="shop_link"><? echo $value[1];?></a></td>
 <td align="center"><? echo $value[3]?></td> 
 <td align="center"><? echo $value[0]?></td>
 <td align="center"><a href="/page/<? echo $_GET['page'];?>/del/<? echo $id;?>"><img src="<? echo DIR_MAIN_IMAGES; ?>/btn_shop_del.png"></a></td>
</tr>     
        <?
	}
?>
</table>
<div class="shop_summa" style="line-height: 42px;">Общая сумма = <span style="font-size:16px;"><? echo $_SESSION['summa']; ?></span> баллов</div>
<?	
    if(empty($_SESSION['user_name'])) echo '<div class="shop_warning"><img src="/image/warning.png" align="middle" style="margin-right:15px;">Для того, чтобы сделать заказ, Вам необходимо зарегистрироваться</div>';
	elseif($_SESSION['balls']<$_SESSION['summa']) echo '<div class="shop_warning"><img src="/image/warning.png" align="middle" style="margin-right:15px;">Недостаточно баллов для заказа.</div>';
	elseif($_SESSION['summa']>0)
	{
?>
<div class="shop_summa">
<form method="post">
	<input type="submit" value=" " name="order" style="border:none; background: url(<? echo DIR_MAIN_IMAGES; ?>/btn_shop_order.png) no-repeat; width:212px; height:42px; cursor:pointer;">
</form>
</div>
<?
	}
?>
<div style="clear:left;height:35px;"></div>
<?
}
?>