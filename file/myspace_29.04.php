<script language="javascript" type="text/javascript">
function checkcard() 
{
if (document.forms.changedata.passwordnew.value != document.forms.changedata.passwordnew2.value)
 {
   alert ( "Поля пароли не совпадают, или они не заполнены!" );
   return false;
 }
}

function isValidEmail (email)
{
 return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}
</script>
<script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>
<script language="javascript" type="text/javascript">
    var card, cardStat;
    $(function() {
 // Card
	$("#cardCheck").change(function(){
		card = $("#cardCheck").val();
		var expCard = /^[0-9]{1,10}$/g;
		var resCard = card.search(expCard);
		if(resCard == -1){
			$("#msgbox-card").text("Неверный номер").css({
                                                        'color':'red',
                                                        'display':'inline-block'}).fadeIn(400);
			cardStat = 0;
			buttonOnAndOff();
		}else{
			
			$.ajax({
			url: "file/check.php",
			type: "POST",
			data: "card=" + card,
			cache: false,			
			success: function(response){
				if(response == "no"){
					$("#msgbox-card").text("Номер уже существует").css({
                                                        'color':'red',
                                                        'display':'inline-block'}).fadeIn(1000);
				}else{
                                                                                             $("#msgbox-card").text("Номер не существует").css({
                                                        'color':'green',
                                                        'display':'inline-block'}).fadeIn(1000);
				}				
			}
		});
			cardStat = 1;
			buttonOnAndOff();
		}
		
	});	
	$("#cardCheck").keyup(function(){
		$("#msgbox-card").text("");
	});
                
	function buttonOnAndOff(){
		if(cardStat == 1){
			$("#submit").removeAttr("disabled");
		}else{
			$("#submit").attr("disabled","disabled");
		}
	
	}
        });
</script>

<? 
	if($_SESSION['id_user'])
	{
?>
<div style="background: url(<? echo DIR_MAIN_IMAGES;?>/pc_dline.png) repeat-x;">
<? 
	if(!isset($_GET['cabinet'])) $_GET['cabinet']=0;
$pc_menu=array (array ('Профиль','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/0'),array ('Ваши Покупки','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/1')
,array ('Сообщения','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/2'),array ('начисления <span style="text-transform:none;">f</span>B','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/3'),
array ('Рефералы','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/4'),array ('Деньги','/page/'.NUMBER_PAGE_PCABINET.'/cabinet/5'));

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
	if($_POST['email']!='(пусто)'&&$_POST['email']&&$_POST['email']!=$_SESSION['email'])
	{
		$_SESSION['email']=$_POST['email'];
		$sql="UPDATE member SET email='".$_POST['email']."' WHERE id='".$_SESSION['id_user']."'";
		$result=mysql_query($sql,$db) or die('email не занесен в базу. Обратитесь к администратору.');	
		$_SESSION['ch'][2]=1;
	}
	$_SESSION['changed']=3;
	echo '<script language="javascript">
	top.location.href="/page/'.CHANGED_PAGE.'";
	</script>';
}
elseif($_POST['add_creditcard']&&$_SESSION['balance']>0)
{
	// сохранить новые данные, сделать mail и запись в бд о новой заявке
	 
 	$sql="SELECT balance FROM member WHERE id='".$_SESSION['id_user']."'";
	$res=mysql_query($sql,$db) or die('нет связи с БД 1');
	if($row=mysql_fetch_row($res))
	{
		$balance=$row[0];
	}
	
	$sql="INSERT INTO cashback SET id='".$_SESSION['id_user']."', text='".$_POST['creditcard']."', date_cashback='".date("Y-m-d")."', summa='".$balance."', reading='1'";
	mysql_query($sql,$db) or die('нет связи с БД 2');
	
	$sql="UPDATE member SET credit='".$_POST['creditcard']."', balance='0' WHERE id='".$_SESSION['id_user']."'";
	mysql_query($sql,$db) or die('нет связи с БД 3');
	$_SESSION['balance']=0;
	// передать переменную SESSION для вывода, что ВАША ЗАЯВКА ПЕРЕДАНА
	$_SESSION['changed']=8;
	echo '<script language="javascript">
	top.location.href="/page/'.CHANGED_PAGE.'";
	</script>';
}
elseif($_POST['cash']&&$_SESSION['balance']>0)
{
?>
<div class="notify_box" style="height:312px;">
  <div class="notify_left">
<form method="post" onsubmit="confirm('Вы правильно ввели расчетный счет (номер карты)?')">
<div style="margin:15px;"></div>Укажите номер карточки (расчетный счет), куда Вам перечислить деньги... <p></p>
<div style="margin:15px;"></div>
 <textarea name="creditcard" style="width:100%;"><? 
 	$sql="SELECT credit FROM member WHERE id='".$_SESSION['id_user']."'";
	$res=mysql_query($sql,$db) or die('нет связи с БД');
	if($row=mysql_fetch_row($res))
	{
		echo $row[0];
	}
	?></textarea>
 <div align="center"><input type="submit" name="add_creditcard" value="Подтвердить" class="notify_btn"/></div>
</form>
  </div>
</div>
<?		
}
elseif($_GET['edit']==1)
{
?>
<div class="notify_box" style="height:312px;">
	<div class="notify_left">
<form method="post" name="changedata" onsubmit="return checkcard()" >
<table cellpadding="0" cellspacing="9" border="0">
<tr>
 <td>e-mail:</td>
 <td><input type="text" name="email" class="notify_input" maxlength="50" value="<? if($_SESSION['email']!='(пусто)') echo $_SESSION['email'];?>"></td>
</tr>
<tr>
 <td></td>
 <td></td>
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
} elseif($_POST['cardCheck']) {
    $numberCard = $_POST['card'];
    $enterCard = preg_match("/^[0-9]{1,9}$/", $numberCard);
    if(!$enterCard) {
        echo "<div align=\"center\"><b>Карточка неверна!</b></div>
            <div valign=\"top\" align=\"center\"><input type=\"button\" value=\"Назад\"onClick=\"goBack()\"></div>";
        $error = 1;
    } 
    if($error != 1) {
        $numberCard = str_pad($numberCard,9,0,STR_PAD_LEFT);
        $msg = 'Внутренняя ошибка. Пожалуйста свяжитесь с нами по email - info@freebonline.com';
        $sql = "SELECT * FROM `member` WHERE `number_card`='".$numberCard."'";
        $res_query = mysql_query($sql,$db) or die($msg);
        $numrow = mysql_num_rows($res_query);
        if($numrow == 1) {
             echo "<div align=\"center\"><b>Карточка такая уже существует!</b></div>
            <div valign=\"top\" align=\"center\"><input type=\"button\" value=\"Назад\"onClick=\"goBack()\"></div>";
        } else {
        $sql_query = "UPDATE `member` SET `number_card`='".$numberCard."'  WHERE `inet_number`='".$_SESSION['inet_number']."'";
        $mysql_query = mysql_query($sql_query,$db) or die($msg);
       echo "<div align=\"center\"><b>Карточка успешно добавлена!</b></div>
            <div valign=\"top\" align=\"center\"><input type=\"button\" value=\"Назад\"onClick=\"goBack()\"></div>";
       $_SESSION['number_card'] = $numberCard;
    }
    }
} elseif($_GET['edit'] == 2) {
    if($_SESSION['number_card'] != NULL) {
        echo "<div align=\"center\"><b>У Вас уже зарегистрирована карточка. Новую добавить нельзя!</b></div>
            <div valign=\"top\" align=\"center\"><input type=\"button\" value=\"Назад\"onClick=\"goBack()\"></div>";
    } else {
    ?>
    <form method="post" >
<table cellpadding="0" cellspacing="9" border="0">
    <tr>
 <td>Номер карточки:</td>
 <td width="400px;"><input type="text" id="cardCheck" name="card" class="notify_input" maxlength="50" value=""><div style="position:relative; "  id="msgbox-card"></div></td>
</tr>
<tr>
 <td colspan="2" align="center" style="padding-top:15px;"><input type="submit" id="submit" name="cardCheck" value="Сохранить" class="notify_btn" disabled="disabled"><input type="button" onclick="goBack()" value="Отмена" style="margin-left:15px;" class="notify_btn"/></td>
</tr>
</table>
  </form>
<?php
}
}
else
{
if($_GET['cabinet']==1||$_GET['cabinet']==3) include(DIR_MAIN_FILE.'/history.php');
elseif($_GET['cabinet']==2) include(DIR_MAIN_FILE.'/mail.php');
elseif($_GET['cabinet']==4) include(DIR_MAIN_FILE.'/my_referal.php');
elseif($_GET['cabinet']==5) include(DIR_MAIN_FILE.'/my_money.php');
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
 <div style="font-size:13px;font-weight: normal; margin-top:20px; margin-left:25px;">
        <a href="/page/<? echo $_GET['page'];?>/edit/1" class="pc_edit"><img src="<? echo DIR_MAIN_IMAGES;?>/pc_edit.png"
        align="left" border="0" style="margin-right:5px; margin-top:-8px;"/>Изменить пароль или e-mail</a><br>
        <a href="/page/<?php echo $_GET['page']; ?>/edit/2" class="pc_edit">Привязать номер карточки</a>
        </div> 
        
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
        <div style="font-size:16px;"><? if($_SESSION['number_card'] != NULL) echo $_SESSION['number_card']; else echo  $_SESSION['inet_number']; ?></div>

        
        </div>
    <div style="clear:left"></div>
 </div>
 <div style="float:right; line-height:34px; font-weight:bold; width: 200px;">
 	<div style="float:left;font-size:18px; margin-right:25px;">Ваш<br />баланс:</div>
 	<div style="float:left;font-size:18px;"><img src="<? echo DIR_MAIN_IMAGES;?>/pc_kosh.png"/></div>
    <div style="clear:left;"></div>
    <div style="font-size:18px; text-align:center; margin-top:20px;"><span style="font-size:36px;"><? echo $_SESSION['balls']; ?> fB</span></div> 
    <div style="font-size:18px; text-align:center; margin-top:20px;"><span style="font-size:36px;"><? echo $_SESSION['balance']; ?> грн.</span><? if($_SESSION['balance']>0) {?>
<form method="post">
 
  <input type="submit" name="cash" value="Снять деньги" class="notify_btn"/>
  
</form>
    <? } ?></div> 

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
	top.location.href="/page/'.CHANGED_PAGE.'";
	</script>';
	 }
?>
