<? 
//if($_POST['add_referal1'])
//{
//	$sql="INSERT INTO member SET 
//	number_card='".$_POST['ncard']."', 
//	login='".$_POST['email']."', 
//	password='".(md5($_POST['ncard']))."',
//	f_name='".$_POST['f_name']."',	
//	s_name='".$_POST['s_name']."',	
//	t_name='".$_POST['t_name']."',	
//	phone='".$_POST['mobile']."',
//	birthday='".$_POST['date']."',	
//	email='".$_POST['email']."',	
//	balls='0',	
//	change_balls='0', 
//	saved_money='0',
//country='Украина', 
//city='Херсон', 
//sex='".$_POST['sex']."',
//	datereg='".date("Y-m-d H:i:s")."',	
//	all_balls='0', 
//	all_product='0',
//	 parent='".$_SESSION['id_user']."',
//	  balance='0',
//	diller='0'";
//	mysql_query($sql,$db) or die('Реферал не добавлен. Ошибка записи в б/д');	
//	echo 'Зарегистрировано';
//}
//else
if($_POST['add_referal'])
{
?><div class="notify_box" style="height:312px;">
 <div class="vender_name" align="center">Проверка данных</div>
 <div class="notify_left">

 	<div style="float:left; width:125px; line-height:34px;">
        <div>ФИО:</div>
        <div>e-mail:</div>
        <div>День рожденье:</div>
        <div>Телефон:</div>
        <div>Пол:</div>
        <div>№ карточки:</div>
    </div>
 	<div style="float:left; line-height:34px;font-weight:bold; color:#666;">
        <div style="font-size:16px;"><? echo $_POST['t_name'].' '.$_POST['f_name'].' '.$_POST['s_name']; ?></div>
        <div style="font-size:13px; text-decoration: underline;font-weight: normal;"><? echo $_POST['email']; 
		$sql="SELECT * FROM member WHERE email='".$_POST['email']."'";
		if($row=mysql_fetch_row(mysql_query($sql,$db)))
		{ echo '<span style="color:#f00; text-decoration:none;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* такой e-mail уже есть в системе</b></span>'; $no=1; }
		?></div>
        <div style="font-size:16px;"><? 
		if(strlen($_POST['date_m'])==1) $_POST['date_m']='0'.$_POST['date_m'];
		if(strlen($_POST['date_d'])==1) $_POST['date_d']='0'.$_POST['date_d'];
		echo $_POST['date_d'].'.'.$_POST['date_m'].'.'.$_POST['date_y']; ?></div>
        <div style="font-size:16px;">
        <img src="<? echo DIR_MAIN_IMAGES;?>/pc_mob.png" align="left" style="margin-right:5px; margin-top:8px;"/>
		<? echo $_POST['mobile'];
		$sql="SELECT * FROM member WHERE phone='".$_POST['mobile']."'";
		if($row=mysql_fetch_row(mysql_query($sql,$db)))
		{  echo '<span style="color:#f00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* такой телефон уже есть в системе</span>'; $no=1; }
		if(empty($_POST['mobile'])||!is_numeric($_POST['mobile'])) { echo '<span style="color:#f00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* неверно указан телефон</span>'; $no=1; }
	 ?></div>
        <div style="font-size:16px;"><? if($_POST['sex']==1) echo 'Мужской'; else 'Женский'; ?></div>
        <div style="font-size:16px;"><? $_POST['ncard']=str_repeat('0',9-strlen($_POST['ncard'])).$_POST['ncard']; 
		echo $_POST['ncard'];
		
		$sql="SELECT * FROM member WHERE number_card='".$_POST['ncard']."'";
		if($row=mysql_fetch_row(mysql_query($sql,$db)))
		{  echo '<span style="color:#f00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* такая карточка уже зарегистрирована</span>'; $no=1; }

		?></div>
        </div>
    <div style="clear:left"></div>

<form method="post">
 <input type="hidden" value="<? echo $_POST['ncard'];?>" name="ncard"/>
  <input type="hidden" value="<? echo $_POST['sex'];?>" name="sex"/>
  <input type="hidden" value="<? echo $_POST['mobile'];?>" name="mobile"/>
  <input type="hidden" value="<? echo $_POST['date_y'].'-'.$_POST['date_m'].'-'.$_POST['date_d'];?>" name="date"/>
  <input type="hidden" value="<? echo $_POST['date_d'];?>" name="date_d"/>
  <input type="hidden" value="<? echo $_POST['date_m'];?>" name="date_m"/>
  <input type="hidden" value="<? echo $_POST['date_y'];?>" name="date_y"/>
  <input type="hidden" value="<? echo $_POST['email'];?>" name="email"/>
  <input type="hidden" value="<? echo $_POST['sex'];?>" name="sex"/>
  <input type="hidden" value="<? echo $_POST['t_name'];?>" name="t_name"/>
  <input type="hidden" value="<? echo $_POST['s_name'];?>" name="s_name"/>
  <input type="hidden" value="<? echo $_POST['f_name'];?>" name="f_name"/> 
<table>
<tr>
 <td colspan="2" align="center" style="padding-top:15px;"><? if($no==0) {?><input type="submit" name="add_referal1" value="Добавить" class="notify_btn"/>
 <? } else echo '<span style="color:#f00">Вы не можете добавить реферала, пока не устраните ошибки!</span>';?><input type="submit" value="Назад" style="margin-left:15px;" class="notify_btn"/></td>
</tr>
</table>
  </form> 	
 </div>
</div>
<?	
}
elseif($_GET['add'])
{
?><div class="notify_box" style="height:312px;">
<div class="vender_name" align="center">Добавление реферала</div>
<div class="notify_left">
<form method="post">
<table cellpadding="0" cellspacing="9" border="0">
<tr>
 <td>Фамилия:</td>
 <td><input type="text" name="t_name" class="notify_input" maxlength="50" value="<? echo $_POST['t_name'];?>"></td>
</tr>
<tr>
 <td>Имя:</td>
 <td><input type="text" name="f_name"  class="notify_input" maxlength="50" value="<? echo $_POST['f_name'];?>" /></td>
</tr>
<tr>
 <td>Отчество:</td>
 <td><input type="text" name="s_name" class="notify_input" maxlength="50" value="<? echo $_POST['s_name'];?>" /></td>
</tr>
<tr>
 <td>e-mail:</td>
 <td><input type="text" name="email" class="notify_input" maxlength="50" value="<? echo $_POST['email'];?>" /></td>
</tr>
<tr>
 <td>Дата рождения:</td>
 <td><select name="date_d"><option selected="selected">День</option>
 <? for($i=1;$i<=31;$i++) 
 {	echo '<option';
 if($i==$_POST['date_d']) echo ' selected="selected" ';
 echo '  value='.$i.'>'.$i.'</option>';
 }?></select>
 <select name="date_m"><option selected="selected">Месяц</option><? for($i=1;$i<=12;$i++) { echo '<option';
 if($i==$_POST['date_m']) echo ' selected="selected" ';
 echo '  value='.$i.'>'.$month[$i].'</option>';}?></select>
 <select name="date_y"><option selected="selected">Год</option><? for($i=1994;$i>=1940;$i--) { echo '<option';
 if($i==$_POST['date_y']) echo ' selected="selected" ';
 echo '  value='.$i.'>'.$i.'</option>'; }?></select></td>
</tr>
<tr>
 <td>Пол:</td>
 <td><select name="sex"><option selected="selected">Пол</option><option <? if($_POST['sex']=='1') echo  'selected="selected"';?> value="1">Мужской</option><option <? if($_POST['sex']=='0') echo  'selected="selected"';?> value="0">Женский</option></select></td>
</tr>
<tr>
 <td>Телефон:</td>
 <td><input type="text" name="mobile" class="notify_input" maxlength="10" value="<? echo $_POST['mobile'];?>" /> (пример 0501234567 или 0931234567)</td>
</tr>
<tr>
 <td>№ Карточки:</td>
 <td><input type="text" name="ncard" class="notify_input" maxlength="9" value="<? echo $_POST['ncard'];?>"> (пример 000000001 или 1)</td>
</tr>
<tr>
 <td colspan="2" align="center" style="padding-top:15px;"><input type="submit" name="add_referal" value="Добавить" class="notify_btn"/><input type="button" onclick="javascript:history.back()" value="Отмена" style="margin-left:15px;" class="notify_btn"/></td>
</tr>
</table>
  </form>
		</div>
</div><?
}
else
{
?><div class="vender_name">Ваш баланс: <? echo $_SESSION['balance'];?> грн.</div>
<!-- <div class="vender_name"><a href="/page/<? //echo $_GET['page'];?>/cabinet/<? //echo $_GET['cabinet'];?>/add/1">Добавить реферала</a></div> -->
<form method="post">
<table style="margin-left:20px;">
<tr>
 <? 
 if(empty($_POST['date_d'])) $_POST['date_d']=01;
 if(empty($_POST['date_m'])) $_POST['date_m']=date("m");
 if(empty($_POST['date_y'])) $_POST['date_y']=date("Y");
?>
 <td style="color:#666; font-weight:bold;">Показан период. с :</td>
 <td><select name="date_d">
 <? for($i=1;$i<=31;$i++) 
 {	echo '<option';
 if($i==$_POST['date_d']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>';
 }?></select>
 <select name="date_m"><? for($i=01;$i<=12;$i++) { echo '<option';
 if($i==$_POST['date_m']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$month[$i].'</option>';}?></select>
 <select name="date_y">
 <? for($i=2012;$i<=date("Y");$i++) { echo '<option';
 if($i==$_POST['date_y']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>'; }?></select></td>
<?
 if(empty($_POST['date_d1'])) $_POST['date_d1']=date("d");
 if(empty($_POST['date_m1'])) $_POST['date_m1']=date("m");
 if(empty($_POST['date_y1'])) $_POST['date_y1']=date("Y");
?>
 <td style="color:#666; font-weight:bold;" width="50" align="right">по :</td>
 <td><select name="date_d1">
 <? for($i=01;$i<=31;$i++) 
 {	echo '<option';
 if($i==$_POST['date_d1']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>';
 }?></select>
 <select name="date_m1"><? for($i=1;$i<=12;$i++) { echo '<option';
 if($i==$_POST['date_m1']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$month[$i].'</option>';}?></select>
 <select name="date_y1">
 <? for($i=2012;$i<=date("Y");$i++) { echo '<option';
 if($i==$_POST['date_y1']) echo ' selected="selected" ';
 echo ' value='.$i.'>'.$i.'</option>'; }?></select></td>
 <td><input type="submit" value="Поиск" name="search"/></td>
</tr>
</table>
</form>

<table cellpadding="10" cellspacing="1" border="0" bgcolor="#dcdfe1" width="700" align="center" style="margin-top:10px;">
<tr bgcolor="#971d81" style="color:#fff; font-weight: bold;">
 <td align="center" width="100">№ карточки</td>
 <td align="center">Ф.И.О.</td>
 <td align="center">Сделано покупок</td>
 <td align="center">Ваш доход</td>
</tr>
<? 
	if(strlen($_POST['date_m'])==1) $_POST['date_m']='0'.$_POST['date_m'];
	if(strlen($_POST['date_d'])==1) $_POST['date_d']='0'.$_POST['date_d'];
	if(strlen($_POST['date_m1'])==1) $_POST['date_m1']='0'.$_POST['date_m1'];
	if(strlen($_POST['date_d1'])==1) $_POST['date_d1']='0'.$_POST['date_d1'];	
	
	if($_POST['search']) $ch_date=" AND date_buy BETWEEN '".$_POST['date_y']."-".$_POST['date_m']."-".$_POST['date_d']."' AND '".$_POST['date_y1']."-".$_POST['date_m1']."-".$_POST['date_d1']."'";
	// echo $ch_date;
	$sql="SELECT id, number_card, f_name, s_name, t_name FROM member WHERE parent='".$_SESSION['id_user']."' ORDER BY number_card ASC";
	$res=mysql_query($sql,$db);
	while($row=mysql_fetch_row($res))
	{?>

<tr  bgcolor="#fff" style="color:#666666;">
 <td align="center" width="100"><? echo $row[1];?></td>
 <td align="left"><? echo $row[4].' '.$row[2].'.'.$row[3];?></td>
 <td align="center"><?
 		$sql1="SELECT price, balls FROM member_backcash WHERE id_user='".$_SESSION['id_user']."' AND wherefromballs='".$row[0]."'".$ch_date;
		$res1=mysql_query($sql1,$db) or die('Trable');
	//	echo $sql1;
		$price=0;
		$item=0;
		while($row1=mysql_fetch_row($res1))
		{
			$price+=$row1[0];
			$item+=$row1[1];
		}
		echo $price;
 ?> грн.</td>
 <td align="center"><? echo $item.' грн.'; ?></td>
</tr>
<?
	}
?>
</table>
<?
}
?>
<div style="height:25px;"></div>