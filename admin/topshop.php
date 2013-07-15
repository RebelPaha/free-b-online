<?php
/**
 * Created by Godod.
 * Date: 20.12.12
 * Time: 13:45
 */
if ($_SESSION['lvl'] != 0) {
    echo 'Недостаточно прав доступа';
} else {
// -- Здесь задается обновление базы данных для каждого пользователя,
// -- т.е. когда мы сохраняем или отменяет, то выполняется определенное действие --
    if ($_POST['Save_Admin']) {
        $sql = "UPDATE `vender` SET `topshop` = '" . $_POST['topshop'] . "', `name` = '" . $_POST['name'] . "' WHERE `id` ='" . $_GET['edit'] . "'";
        $result = mysql_query($sql, $db) or die("Ошибка обновление данных в vender - " . mysql_error());
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';
    }
    if ($_POST['Cancel']) {
        echo '<script language="javascript">
    top.location.href="./' . $url_page . '";
</script>';
 } else {
// -- Если просто изменяем параметры нужных нам данных
        if ($_GET['edit'] && is_numeric($_GET['edit'])) {
            if ($_SESSION['lvl'] == 0) $level = 'Save_Admin';
            $sql = "SELECT `topshop`,`name` FROM vender WHERE id='" . $_GET['edit'] . "'";
            $res = mysql_query($sql, $db) or die("Ошибка выборки всех данных из vender - " . mysql_error());
            $row = mysql_fetch_row($res);
            ?>
        <form method="post">
            <fieldset style="border: 1px solid #000000; padding: 4px 4px 4px 4px; width:99%;">
                <legend>&nbsp;Редактирование вендера&nbsp;</legend>
                <table cellpadding="0" cellspacing="6" border="0" width="100%">
                    <tr>
                        <td valign="top" width="20px">Номер топа</td>
                        <td valign="top" align="left"><input type="text" size="10" name="topshop"
                                                             value="<?php echo $row[0]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="100px">Имя вендера</td>
                        <td valign="top" align="left"><input type="text" size="50" name="name"
                                                             value="<?php echo stripcslashes(htmlspecialchars($row[1],ENT_QUOTES)); ?>">
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br/>

            <div align="center">
                <input type="submit" name="Save_Admin" value="Сохранить">
                &nbsp;&nbsp;<input type="submit" name="Cancel" value="Отмена">
            </div>
        </form>
        <?php
            // -- Просмотр всех топов --
        } else {
            ?>
        <form method="post">
            <table class="gifts">
                <tr class="header">
                    <td>Номер в топе</td>
                    <td>Имя вендера</td>
                </tr>
                <?php
                // -- Делаем запрос на выборку. Все в одном запросе, чтобы уменьшить кол-во запросов к базе, тем самым увеличив производительность --
                $query = "SELECT `topshop`,`name`,`id` FROM vender WHERE `topshop` >= '1' ORDER by `topshop` ASC";
                $mysql_query = mysql_query($query, $db) or die('Выборки данных из vender по topshop - ' . mysql_error());
                while ($fetchArray = mysql_fetch_array($mysql_query)) {
                    ?>
	<tr class="main" onclick="top.location.href='<?php echo $url_page."&edit=".$fetchArray[2]."'"?>">
	<?php
                    // -- Выводим все нужные данные --
                    echo '<td>' . $fetchArray[0] . '</td>';
                    echo '<td>' . stripslashes($fetchArray[1]) . '</td>';
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
