<?php
if ($_SESSION['lvl'] != 0) {
    echo 'Недостаточно прав доступа';
} else {
// -- Здесь задается обновление базы данных для каждого пользователя,
// -- т.е. когда мы сохраняем или отменяет, то выполняется определенное действие --
    if ($_POST['Save_Admin']) {
        $sql = "UPDATE `wait_reg` SET `number_card` = '" . $_POST['number_card'] . "', `login` ='" . $_POST['login'] . "', `password` ='" . $_POST['password'] .
            "', `f_name` ='" . $_POST['name'] . "', `s_name` ='" . $_POST['ot'] . "', `t_name` ='" . $_POST['fam'] . "', `phone` ='" . $_POST['login'] . "',
`birthday` ='" . $_POST['birthday'] . "', `email` ='" . $_POST['email'] . "', `sex` ='" . $_POST['sex'] . "',
`datereg` ='" . $_POST['datereg'] . "', `parent` ='" . $_POST['parent'] . "' WHERE `id` ='" . $_GET['edit'] . "'";
        $result = mysql_query($sql, $db) or die("Ошибка обновление данных в wait_reg - " . mysql_error());
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';
    }
    if ($_POST['Delete']) {
        $sql = "DELETE QUICK FROM `wait_reg` WHERE id='" . $_GET['edit'] . "'";
        $result = mysql_query($sql, $db) or die("Ошибка удаления с временно базы wait_reg - " . mysql_error());
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';
    }
    if ($_POST['Cancel']) {
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';
    }
    if ($_POST['saveCheckBox']) {
        $number = array();
        $number = $_POST['check'];
        foreach ($number as $k => $v) {
            $sql = "SELECT * FROM `wait_reg` WHERE number_card='" . $v."'";
            $query_mysql = mysql_query($sql, $db) or die('Ошибка выборки данных из wait_reg. '.mysql_error());
            $mysql_row = mysql_fetch_assoc($query_mysql);
            $sql = "SELECT `id` FROM `member` WHERE number_card='".$mysql_row['parent']."'";
            $query = mysql_query($sql,$db) or die('Ошибка выбора id с таблицы поользователей'.mysql_error());
            $mysql_row1 = mysql_fetch_row($query);
            echo '<br>';
            $sql = "INSERT INTO `member` (`number_card`,`login`,`password`,`f_name`,`s_name`,`t_name`,`phone`,`birthday`,
            `email`,`balls`,`change_balls`,`saved_money`,`country`,`city`,`id`,`sex`,`datereg`,`all_balls`,`all_product`,
            `parent`,`balance`,`diller`,`all_money`,`credit`)
             VALUES('" . $mysql_row['number_card'] . "','" . $mysql_row['login'] . "','" . $mysql_row['password'] . "','" . $mysql_row['f_name'] . "',
             '" . $mysql_row['s_name'] . "','" . $mysql_row['t_name'] . "','" . $mysql_row['login'] . "','" . $mysql_row['birthday'] . "',
             '" . $mysql_row['email'] . "','0','0','0','Украина','Херсон','','" . $mysql_row['sex'] . "','" . $mysql_row['datereg'] . "',
             '0','0','" . $mysql_row1[0] . "','0','0','0','0')";
            $sql_query = mysql_query($sql, $db) or die('Ошибка внесения в базу данных пользователя - '.mysql_error());
            $sql = "DELETE QUICK FROM `wait_reg` WHERE number_card='".$v."'";
            $query = mysql_query($sql,$db) or die('Ошибка удаления записи из wait_reg - '.mysql_error());
        }
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';

    } else {
// -- Если просто изменяем параметры нужных нам данных
        if ($_GET['edit'] && is_numeric($_GET['edit'])) {
            if ($_SESSION['lvl'] == 0) $level = 'Save_Admin';
            $sql = "SELECT * FROM wait_reg WHERE id='" . $_GET['edit'] . "'";
            $res = mysql_query($sql, $db) or die("Ошибка выборки всех данных из wait_reg - " . mysql_error());
            $row = mysql_fetch_row($res);
            ?>
        <form method="post">
            <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;">
                <legend>&nbsp;Редактирование пользователя&nbsp;</legend>
                <table cellpadding="0" cellspacing="6" border="0" width="100%">
                    <tr>
                        <td valign="top" width="50px">Номер карточки</td>
                        <td valign="top" align="left"><input type="text" size="10" name="number_card"
                                                             value="<?php echo $row[1]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Логин</td>
                        <td valign="top" align="left"><input type="text" size="20" name="login"
                                                             value="<?php echo $row[2]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Пароль</td>
                        <td valign="top" align="left"><input type="text" size="40" name="password"
                                                             value="<?php echo $row[3]; ?>"></td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Фамилия</td>
                        <td valign="top" align="left"><input type="text" size="20" name="fam"
                                                             value="<?php echo $row[6]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Имя</td>
                        <td valign="top" align="left"><input type="text" size="20" name="name"
                                                             value="<?php echo $row[4]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Отчество</td>
                        <td valign="top" align="left"><input type="text" size="20" name="ot"
                                                             value="<?php echo $row[5]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">День Рождение</td>
                        <td valign="top" align="left"><input type="text" size="10" name="birthday"
                                                             value="<?php echo $row[8]; ?>">
                            формат: год-месяц-день
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Email</td>
                        <td valign="top" align="left"><input type="text" size="25" name="email"
                                                             value="<?php echo $row[9]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Пол</td>
                        <td valign="top" align="left"><input type="text" size="10" name="sex"
                                                             value="<?php echo $row[10]; ?>">
                            0 - означает женщину, 1 - мужчину.
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Дата регистрации</td>
                        <td valign="top" align="left"><input type="text" size="20" name="datereg"
                                                             value="<?php echo $row[11]; ?>">
                            формат: год-месяц-день часы-минуты-секунды
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="50px">Родитель</td>
                        <td valign="top" align="left"><input type="text" size="10" name="parent"
                                                             value="<?php echo $row[12]; ?>">
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
            // -- Просмотр всех регистраций --
        } else {
            ?>
        <script type="text/javascript">
            $(document).ready(function () {
                // Выбор всех
                //При клике на ссылку "Все", активируем checkbox
                $("a[href='#select_all']").click(function () {
                    $("." + $(this).attr('rel') + " input:checkbox:enabled").attr('checked', true);
                    return false;
                });

                // Ни одного
                $("a[href='#select_none']").click(function () {
                    $("." + $(this).attr('rel') + " input:checkbox").attr('checked', false);
                    return false;
                });
            });
        </script>
        <form method="post">
            <div align="center"><a class="list" href="#"><input name="saveCheckBox" type="submit" value="Сохранить"/></a>
            </div>
            <div align="center">
                <a class="list" rel="group1" href='#select_all'>Выбрать все</a>
                <a class="list" rel="group1" href='#select_none'>Снять выделения</a>
            </div>
            <br>
            <table class="gifts">
                <tr class="header">
                    <td></td>
                    <td></td>
                    <td>Номер карточки</td>
                    <td>Логин</td>
                    <td>Пароль</td>
                    <td>Ф.И.О</td>
                    <td>День рождения</td>
                    <td>Email</td>
                    <td>Пол</td>
                    <td>Дата регистрации</td>
                    <td>Родитель</td>
                </tr>
                <?php
                // -- Делаем запрос на выборку. Все в одном запросе, чтобы уменьшить кол-во запросов к базе, тем самым увеличив производительность --
                $query = "SELECT * FROM wait_reg ORDER by id ASC";
                $mysql_query = mysql_query($query, $db) or die('Выборки данных из wait_reg по id - ' . mysql_error());
                while ($fetchArray = mysql_fetch_array($mysql_query)) {
                    ?>
	<tr class="main">
	<?php
                    // -- Выводим все нужные данные --
                    echo '<td><div class="group1"><input name="check[]" type="checkbox" value="' . $fetchArray[1] . '"></div></td>';
                    echo '<td onclick="top.location.href=\'' . $url_page . '&edit=' . $fetchArray[0] . '\'"><img src="img/b_edit.png"/></td>';
                    echo '<td>' . $fetchArray[1] . '</td>';
                    echo '<td>' . $fetchArray[2] . '</td>';
                    echo '<td>' . $fetchArray[3] . '</td>';
                    echo '<td>' . $fetchArray[6] . ' ' . $fetchArray[4] . ' ' . $fetchArray[5] . '</td>';
                    echo '<td>' . $fetchArray[8] . '</td>';
                    echo '<td>' . $fetchArray[9] . '</td>';
                    if ($fetchArray[10] == 0) $sex = 'Женщина'; else $sex = 'Мужчина';
                    echo '<td>' . $sex . '</td>';
                    echo '<td>' . $fetchArray[11] . '</td>';
                    echo '<td>' . $fetchArray[12] . '</td>';
                }
                ?>
            </tr>
                <table>
        </form>
        <?php
        }
    }
}
?>
