<?php
if ($_SESSION['lvl'] != 0) {
    echo 'Недостаточно прав доступа';
} else {
// -- Здесь задается обновление базы данных для каждого пользователя,
// -- т.е. когда мы сохраняем или отменяет, то выполняется определенное действие --
    if ($_POST['Save_Admin']) {
        $sql = "UPDATE `adminka` SET `id` = '" . $_POST['id'] . "', `login` ='" . $_POST['login'] . "', `password` ='" . md5($_POST['password']) .
            "', `name` ='" . $_POST['name'] . "', `lvl` ='" . $_POST['level'] . "' WHERE `id` ='" . $_GET['edit'] . "'";
        $result = mysql_query($sql, $db) or die("Mysql error - " . mysql_error());
        echo '<script language="javascript">
	top.location.href="./' . $url_page . '";
	</script>';
    }
    if ($_POST['Save_new_Admin']) {
        $sql = "INSERT INTO `adminka` (`login`,`password`,`name`,`lvl`)
        VALUES ('" . $_POST['login'] . "','" . md5($_POST['password']) ."','" . $_POST['name'] . "','" . $_POST['level'] . "')";
        $result = mysql_query($sql, $db) or die("Mysql error - " . mysql_error());
        echo '<script language="javascript">
	top.location.href="./' . $url_page . '";
	</script>';
    }
    if ($_POST['Delete']) {
        $sql = "DELETE QUICK FROM `adminka` WHERE id='" . $_GET['edit'] . "'";
        $result = mysql_query($sql, $db) or die("Mysql error - " . mysql_error());
        echo '<script language="javascript">
	top.location.href="./' . $url_page . '";
	</script>';
    }
    if ($_POST['Cancel']) {
        echo '<script language="javascript">
	top.location.href="./' . $url_page . '";
	</script>';
    }
    if ($_GET['add'] == 1) {
        ?>
    <form method="post">
        <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;">
            <legend>&nbsp;Менеджера&nbsp;</legend>
            <table cellpadding="0" cellspacing="6" border="0" width="100%">
                <tr>
                    <td valign="top" width="50px">Логин</td>
                    <td valign="top" align="left"><input type="text" size="20" name="login"
                                                         value="">
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Пароль</td>
                    <td valign="top" align="left"><input type="text" size="40" name="password"
                                                         value=""></td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Имя</td>
                    <td valign="top" align="left"><input type="text" size="20" name="name"
                                                         value="">
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Уровень доступа</td>
                    <td valign="top" align="left"><input type="text" size="10" name="level"
                                                         value="">
                    </td>
                </tr>
            </table>
        </fieldset>
        <br/>

        <div align="center">
            <input type="submit" name="Save_new_Admin" value="Сохранить">
            &nbsp;&nbsp;<input type="submit" name="Cancel" value="Отмена">
        </div>
    </form>
    <?php
    } // -- Если просто изменяем параметры подарка
    elseif ($_GET['edit'] && is_numeric($_GET['edit'])) {
        if ($_SESSION['lvl'] == 0) $level = 'Save_Admin';
        elseif ($_SESSION['lvl'] == 1) $level = 'Save_SEO';
        $sql = "SELECT * FROM adminka WHERE id='" . $_GET['edit'] . "'";
        $res = mysql_query($sql, $db) or die("Mysql error - " . mysql_error());
        $row = mysql_fetch_row($res);
        ?>
    <form method="post">
        <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;">
            <legend>&nbsp;Менеджера&nbsp;</legend>
            <table cellpadding="0" cellspacing="6" border="0" width="100%">
                <tr>
                    <td valign="top" width="50px">id менеджера</td>
                    <td valign="top" align="left"><input type="text" size="10" name="id" value="<?php echo $row[0]; ?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Логин</td>
                    <td valign="top" align="left"><input type="text" size="20" name="login"
                                                         value="<?php echo $row[1]; ?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Пароль</td>
                    <td valign="top" align="left"><input type="text" size="40" name="password"
                                                         value="<?php echo $row[2]; ?>"></td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Имя</td>
                    <td valign="top" align="left"><input type="text" size="20" name="name"
                                                         value="<?php echo $row[3]; ?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="50px">Уровень доступа</td>
                    <td valign="top" align="left"><input type="text" size="10" name="level"
                                                         value="<?php echo $row[4]; ?>">
                    </td>
                </tr>
            </table>
        </fieldset>
        <br/>

        <div align="center">
            <input type="submit" name="Save_Admin" value="Сохранить">&nbsp;&nbsp;<input type="submit" name="Delete"
                                                                                        value="Удалить">
            &nbsp;&nbsp;<input type="submit" name="Cancel" value="Отмена">
        </div>
    </form>
    <?php
    } else {
        ?>
    <div align="center"><a class="list" href="<?php echo $_SERVER['REQUEST_URI']; ?>&add=1">Добавить</a></div>
    <br>
<table class="gifts">
    <tr class="header">
        <td>id менеджера</td>
        <td>Логин</td>
        <td>Пароль</td>
        <td>Имя</td>
        <td>Уровень доступа</td>
    </tr>
    <?php
    // -- Делаем запрос на выборку. Все в одном запросе, чтобы уменьшить кол-во запросов к базе, тем самым увеличив производительность --
    $query = "SELECT * FROM adminka
			  ORDER by id ASC";
    $mysql_query = mysql_query($query, $db) or die('Ошибка - ' . mysql_error());
    while ($fetchArray = mysql_fetch_array($mysql_query)) {
        ?>
	<tr class="main" <?php if ($_SESSION['lvl'] == 0) { ?>
        onclick="top.location.href='<? echo $url_page; ?>&edit=<? echo $fetchArray[0]; ?>'" <?php } ?>>
	<?php
        // -- Выводим все нужные данные --
        echo '<td>' . $fetchArray[0] . '</td>';
        echo '<td>' . $fetchArray[1] . '</td>';
        echo '<td>' . $fetchArray[2] . '</td>';
        echo '<td>' . $fetchArray[3] . '</td>';
        echo '<td>' . $fetchArray[4] . '</td>';
    }
    ?>
</tr>
    <table>
<?php
}
}
?>