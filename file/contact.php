<?if ($_POST['send']) {    $msg = $_POST['name'] . " \r\n " . $_POST['email'] . " \r\n " . $_POST['text'] . " \r\n " . $_SESSION['number_card'];    //$msg = iconv("utf-8", "cp1251", $msg);    mail("freepopov@ukr.net,info@freebonline.com", "Прислано с сайта free-b", $msg);    $_SESSION['changed'] = 4;    echo '<script language="javascript">	top.location.href="/page/' . CHANGED_PAGE . '";	</script>';}?><div class="vender_main">Контакты</div><div style="float:left; width:380px; margin:20px; color:#971d81; line-height:20px;">    <? echo $TXT_DESCRIPTION;?></div><div style="float:left; width:250px; margin:20px; padding-left:20px; border-left: 1px solid #c3c3c3;color:#971d81;">    <? if ($_SESSION['sending']) {    echo 'Ваше письмо отправлено.<br>';    unset($_SESSION['sending']);}?>    <form method="post" onSubmit="">        <strong>Написать нам</strong><br><br>        ФИО<br>        <input type="text" class="notify_input" name="name"               value="<? if ($_SESSION['user_name']) echo $_SESSION['user_name'];?>"><br>        E-mail<br>        <input type="text" class="notify_input" name="email"               value="<? if ($_SESSION['email']) echo $_SESSION['email'];?>"><br>        <br>        <textarea name="text" style="width:230px; height:200px"></textarea>        <br>        <?php        if (!$_SESSION['number_card']) {            echo 'Номер карточки обязателен!';        }        ?>        <br>        <div align="center"><input type="submit" name="send" value="Отправить" class="notify_btn"/></div>    </form></div>