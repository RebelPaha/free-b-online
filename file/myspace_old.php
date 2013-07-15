<script language="javascript" type="text/javascript">
function checkcard() 
{
if (document.forms.changedata.passwordnew.value != document.forms.changedata.passwordnew2.value)
 {
   alert ( "Поля пароли не совпадают, или они не заполнены!" );
   return false;
 }
}
</script>

<? 
	if($_SESSION['id_user'])
	{
?>
<div style="background: url(<? echo DIR_MAIN_IMAGES;?>/pc_dline.png) repeat-x;">
<? 
	if(!isset($_GET['cabinet'])) $_GET['cabinet']=0;
$pc_menu=array (array ('Профиль','?page='.NUMBER_PAGE_PCABINET.'&cabinet=0'),array ('Ваши Покупки','?page='.NUMBER_PAGE_PCABINET.'&cabinet=1')
,array ('Сообщения','?page='.NUMBER_PAGE_PCABINET.'&cabinet=2'),array ('начисления <span style="text-transform:none">f</span>B','?page='.NUMBER_PAGE_PCABINET.'&cabinet=3'),
array ('Рефералы','?page='.NUMBER_PAGE_PCABINET.'&cabinet=4'));

foreach($pc_menu as $key=>$value)
{
	if($_GET['cabinet']==$key)
    {
    ?>
  <div style="background: url(<? echo DIR_MAIN_IMAGES;?>/pc_choise_l.png) no-repeat; width:12px; height:42px; float:left;"></div>
  <div style="float:left;background: url(<? echo DIR_MAIN_IMAGES;?>/pc_choise_bg.png) repeat-x; height:42px; line-height:42px; padding-left:6px; padding-right:11px; font-weight:bold; text-transform:uppercase; color:#971d81;"><? echo $value[0]?></div>
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
if($_POST['send_check'])
{
	$sql="SELECT password FROM member WHERE id='".$_SESSION['id_user']."'";
	$result=mysql_query($sql,$db) or die('1');
	$row=mysql_fetch_row($result);
	if($_POST['passwordnew']!=''&&md5($_POST['password'])==$row[0])
	{
		// замена пароля
		$pwd=md5($_POST['passwordnew']);
		$sql="UPDATE member SET password='".$pwd."' WHERE id='".$_SESSION['id_user']."'";
		mysql_query($sql,$db);
		$_SESSION['ch'][1]=1;
	}
	// замена данных (?????)
	// 	
	$replace="";
	if($_POST['t_name']!=$_SESSION['t_name']) $replace.=",t_name='".$_POST['t_name']."'";
	if($_POST['f_name']!=$_SESSION['f_name']) $replace.=",f_name='".$_POST['f_name']."'";
	if($_POST['s_name']!=$_SESSION['s_name']) $replace.=",s_name='".$_POST['s_name']."'";
	$date=$_POST['date_y'].'-'.$_POST['date_m'].'-'.$_POST['date_d'];
	if($date!=$_SESSION['birthday']) $replace.=",birthday='".$date."'";	
	if($_POST['sex']!=$_SESSION['sex']) $replace.=",sex='".$_POST['sex']."'";
	if(!empty($replace))
	{
		$sql="UPDATE member SET ".substr($replace,1)." WHERE id='".$_SESSION['id_user']."'";
		mysql_query($sql,$db) or die('2');	
	}
	
	if(empty($_POST['t_name'])&&empty($_POST['f_name'])&&empty($_POST['s_name'])) $_SESSION['user_name']='(пусто)';
	else $_SESSION['user_name']=$_POST['t_name'].' '.$_POST['f_name'].' '.$_POST['s_name'];
	$_SESSION['t_name']=$_POST['t_name'];
	$_SESSION['f_name']=$_POST['f_name'];
	$_SESSION['s_name']=$_POST['s_name'];		
	$_SESSION['birthday']=$date;
	if($_POST['sex']) $_SESSION['sex']='Мужской';
	else $_SESSION['sex']='Женский';
	if($_POST['mobile']!=$_SESSION['phone']) $_SESSION['ch'][2]=$_POST['mobile'];
	if($_POST['ncard']!=''&&$_POST['ncard']!='(пусто)') $_POST['ncard']=str_repeat('0',9-strlen($_POST['ncard'])).$_POST['ncard'];
	if($_POST['ncard']!=$_SESSION['number_card']) 
	{
		$sql="SELECT id FROM member WHERE number_card='".$_POST['ncard']."' LIMIT 1";
		$res=mysql_query($sql,$db);
		if(mysql_fetch_row($res)&&$_SESSION['number_card']!=$_POST['ncard']) $_SESSION['ch'][3]=0;
		elseif($_SESSION['number_card']!=$_POST['ncard']) $_SESSION['ch'][3]=$_POST['ncard'];
	}
	else  $_SESSION['ch'][4]=1;
	$_SESSION['changed']=3;
	echo '<script language="javascript">
	top.location.href="./?page='.CHANGED_PAGE.'";
	</script>';
}
elseif($_GET['edit']==1)
{
?>
<div class="notify_box" style="height:312px;">
	<div class="notify_left">
<form method="post" name="changedata" onsubmit="return checkcard()" >
<table cellpadding="0" cellspacing="9" border="0">
<tr>
 <td>Фамилия:</td>
 <td><input type="text" name="t_name" class="notify_input" maxlength="50" value="<? echo $_SESSION['t_name'];?>"></td>
</tr>
<tr>
 <td>Имя:</td>
 <td><input type="text" name="f_name"  class="notify_input" maxlength="50" value="<? echo $_SESSION['f_name'];?>" /></td>
</tr>
<tr>
 <td>Отчество:</td>
 <td><input type="text" name="s_name" class="notify_input" maxlength="50" value="<? echo $_SESSION['s_name'];?>" /></td>
</tr>
<tr>
 <td>Дата рождения:</td>
 <td><select name="date_d"><option selected="selected">День</option>
 <? for($i=1;$i<=31;$i++) 
 {	echo '<option';
 if($i==date("d",strtotime($_SESSION['birthday']))) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>';
 }?></select>
 <select name="date_m"><option selected="selected">Месяц</option><? for($i=1;$i<=12;$i++) { echo '<option';
 if($i==date("m",strtotime($_SESSION['birthday']))) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$month[$i].'</option>';}?></select>
 <select name="date_y"><option selected="selected">Год</option><? for($i=1994;$i>=1920;$i--) { echo '<option';
 if($i==date("Y",strtotime($_SESSION['birthday']))) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>'; }?></select></td>
</tr>
<tr>
 <td>Пол:</td>
 <td><select name="sex"><option <? if($_SESSION['sex']=='Мужской') echo  'selected="selected"';?> value="1">Мужской</option><option <? if($_SESSION['sex']=='Женский') echo  'selected="selected"';?>  value="0">Женский</option></select></td>
</tr>
<tr>
 <td>Телефон:</td>
 <td><input type="text" name="mobile" class="notify_input" maxlength="10" value="<? echo $_SESSION['phone'];?>" /></td>
</tr>
<tr>
 <td>№ Карточки:</td>
 <td><input type="text" name="ncard" class="notify_input" maxlength="9" value="<? echo $_SESSION['number_card'];?>"> шаблон 000123456</td>
</tr>
<tr style="color:#F00;">
 <td colspan="2" align="center">Номер мобильного телефона проверяется администрацией/ Будьте внимательнее, и правильно вводите номер карточки, иначе Ваши балы, будут начислены другому пользователю</td>
</tr>
<tr>
 <td colspan="2" align="center">Изменение пароля</td>
</tr>
<tr>
 <td>Текущий пароль:</td>
 <td><input type="password" name="password" class="notify_input" maxlength="30"/></td>
</tr>
<tr>
 <td>Новый пароль:</td>
 <td><input type="password" name="passwordnew"  class="notify_input" maxlength="30"/></td>
</tr>
<tr>
 <td>Повторите новый пароль:</td>
 <td><input type="password" name="passwordnew2" class="notify_input" maxlength="30"/></td>
</tr>
<tr>
 <td colspan="2" align="center" style="padding-top:15px;"><input type="submit" name="send_check" value="Изменить" class="notify_btn"/><input type="button" onclick="javascript:history.back()" value="Отмена" style="margin-left:15px;" class="notify_btn"/></td>
</tr>
</table>
  </form>
		</div>
</div>
<div style="margin-top:50px;"></div>
<?
}
else
{
if($_GET['cabinet']==1||$_GET['cabinet']==3) include(DIR_MAIN_FILE.'/history.php');
elseif($_GET['cabinet']==2) include(DIR_MAIN_FILE.'/mail.php');
elseif($_GET['cabinet']==4) include(DIR_MAIN_FILE.'/my_referal.php');
else
{
	if($_SESSION['change_password'])
	{
?>
<div style="margin:15px 25px; color:#971d81;">
<img src="<? echo DIR_MAIN_IMAGES; ?>/warning.png" style="margin-right:15px; float:left;"/>
<div style="margin-top:7px; float:left;">рекомендуем изменить свой пароль.</div>
<div style="clear:left;"></div>
</div>
<?
	}
?>
<div style="margin:20px; color:#971d81">
 <div style="float:left">
 	<div style="float:left; width:125px; line-height:34px;">
    	<div>Дата регистрации:</div>
        <div>ФИО:</div>
        <div>e-mail:</div>
        <div>День рожденье:</div>
        <div>Телефон:</div>
        <div>Пол:</div>
        <div>Город:</div>
        <div>№ карточки:</div>
    </div>
 	<div style="float:left; line-height:34px;font-weight:bold; color:#666;">
        <div style="font-size:16px;"><? echo date("d.m.Y",strtotime($_SESSION['datareg'])); ?></div>
        <div style="font-size:16px;"><? echo $_SESSION['user_name']; ?></div>
        <div style="font-size:13px; text-decoration: underline;font-weight: normal;"><? echo $_SESSION['email']; ?></div>
        <div style="font-size:16px;"><? if(empty($_SESSION['birthday'])||$_SESSION['birthday']=='0000-00-00') echo '(пусто)'; else echo date("d.m.Y",strtotime($_SESSION['birthday'])); ?></div>
        <div style="font-size:16px;">
        <img src="<? echo DIR_MAIN_IMAGES;?>/pc_mob.png" align="left" style="margin-right:5px; margin-top:8px;"/>
		<? if($_SESSION['phone']!='(пусто)') echo '('.substr($_SESSION['phone'],0,3).')&nbsp;'.substr($_SESSION['phone'],3,3).'-'.substr($_SESSION['phone'],6,2).'-'.substr($_SESSION['phone'],8); 
			else echo '(пусто)';?></div>
        <div style="font-size:16px;"><? echo $_SESSION['sex']; ?></div>
        <div style="font-size:16px;"><? echo $_SESSION['city']; ?></div>
        <div style="font-size:16px;"><? echo $_SESSION['number_card']; ?></div>
   <div style="font-size:13px;font-weight: normal; margin-top:20px;">
        <a href="?page=<? echo $_GET['page'];?>&edit=1" class="pc_edit"><img src="<? echo DIR_MAIN_IMAGES;?>/pc_edit.png" align="left" border="0" style="margin-right:5px;"/>Запрос на изменение данных</a>
        </div> 

        
        </div>
    <div style="clear:left"></div>
 </div>
 <div style="float:right; line-height:34px; font-weight:bold; width: 200px;">
 	<div style="float:left;font-size:18px; margin-right:25px;">Ваш<br />баланс:</div>
 	<div style="float:left;font-size:18px;"><img src="<? echo DIR_MAIN_IMAGES;?>/pc_kosh.png"/></div>
    <div style="clear:left;"></div>
    <div style="font-size:18px; text-align:center; margin-top:20px;"><span style="font-size:36px;"><? echo $_SESSION['balls']; ?> fB</span></div> 
    <div style="font-size:18px; text-align:center; margin-top:20px;"><span style="font-size:36px;"><? echo $_SESSION['balance']; ?> грн.</span></div> 

    <div style="font-size:18px; margin-top:20px;">Вы сэкономили:</div> 
    <div style="font-size:18px; text-align:center; width:168px; height:34px; background:url(image/pc_econom.png)"><? echo $_SESSION['saved_money'];?> грн.</div> 
 </div>
 <div style="clear:both"></div>
 <div style="margin-top:40px;font-size:18px; font-weight: bold;">Последнее уведомление</div>
 <?
	$sql="SELECT * FROM member_mail WHERE id_user='".$_SESSION['id_user']."' ORDER BY datemsg DESC limit 1";
	$res=mysql_query($sql,$db) or die('нет связи с БД');
	if($row=mysql_fetch_row($res))
	{
?>
  <div style="border-bottom:#dee5e9 1px solid; margin-top:10px; padding-bottom:10px; color:#971d81">
	<div style="float:left; width: 80px;"><? echo date("d.m.Y",strtotime($row[3]));?></div>
    <div style="float:left; color:#666"><? echo $row[1];?></div>
    <div style="clear:left"></div>
  </div>
<?
	}
?>
 <div style="margin-top:40px;font-size:18px; font-weight: bold;">Ожидающие подарки:</div>
<table cellpadding="10" cellspacing="1" border="0" bgcolor="#dcdfe1" width="700" align="center" style="margin-top:10px;">
<tr bgcolor="#971d81" style="color:#fff; font-weight: bold;">
 <td align="center">Дата</td><td align="center">Наименование</td><td align="center">Баллов</td><td align="center">Кол-во</td><td align="center">Итого</td><td align="center">Статус</td>
</tr><?
// Уведомления о покупке.
	$sql="SELECT dateorder, id_product, number, balls, link_url, status, message FROM orders WHERE id_user='".$_SESSION['id_user']."' ORDER BY dateorder DESC";
	$result=mysql_query($sql,$db);
	while($row=mysql_fetch_row($result))
	{
		$sql1="SELECT name FROM product WHERE id='".$row[1]."' LIMIT 1";
		$res1=mysql_query($sql1,$db);
		$row1=mysql_fetch_row($res1);
		?>
<tr bgcolor="#fff" style="color:#666666;">
 <td align="center"><? echo date("d.m.Y",strtotime($row[0])); ?></td> 
 <td><a class="shop_link" href="<? echo $row[4];?>"><? echo $row1[0];?></a></td>
 <td align="center"><? echo $row[3];?></td> 
 <td align="center"><? echo $row[2];?></td>
 <td align="center"><? echo $row[3]*$row[2];?></td>
 <td align="center"><? if($row[5]) echo 'Активен'; else echo 'Обрабатывается'; ?></td>
</tr>     
        <?
	}
?>
</table>
</div>
<?
	}
}
}
	 else 
	 {
		$_SESSION['changed']=1;
		echo '<script language="javascript">
	top.location.href="./?page='.CHANGED_PAGE.'";
	</script>';
	 }
?>