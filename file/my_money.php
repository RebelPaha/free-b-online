<div class="vender_name">
    Итого получено <?php echo $_SESSION['money']; ?> грн
</div>
<form method="post">
    <table style="margin-left:20px;">
        <tr>
            <?php
            if (empty($_POST['date_d'])) $_POST['date_d'] = 01;
            if (empty($_POST['date_m'])) $_POST['date_m'] = 07;
            if (empty($_POST['date_y'])) $_POST['date_y'] = 2012;
            ?>
            <td style="color:#666; font-weight:bold;">Показан период. с :</td>
            <td><select name="date_d">
                <?php for ($i = 1; $i <= 31; $i++) {
                echo '<option';
                if ($i == $_POST['date_d']) echo ' selected="selected" ';
                echo ' value=' . $i . '>' . $i . '</option>';
            }?></select>
                <select name="date_m"><?php for ($i = 01; $i <= 12; $i++) {
                    echo '<option';
                    if ($i == $_POST['date_m']) echo ' selected="selected" ';
                    echo ' value=' . $i . '>' . $month[$i] . '</option>';
                }?></select>
                <select name="date_y">
                    <?php for ($i = 2012; $i <= date("Y"); $i++) {
                    echo '<option';
                    if ($i == $_POST['date_y']) echo ' selected="selected" ';
                    echo ' value=' . $i . '>' . $i . '</option>';
                }?></select></td>
            <?php
            if (empty($_POST['date_d1'])) $_POST['date_d1'] = date("d");
            if (empty($_POST['date_m1'])) $_POST['date_m1'] = date("m");
            if (empty($_POST['date_y1'])) $_POST['date_y1'] = date("Y");
            ?>
            <td style="color:#666; font-weight:bold;" width="50" align="right">по :</td>
            <td><select name="date_d1">
                <?php for ($i = 01; $i <= 31; $i++) {
                echo '<option';
                if ($i == $_POST['date_d1']) echo ' selected="selected" ';
                echo ' value=' . $i . '>' . $i . '</option>';
            }?></select>
                <select name="date_m1"><?php for ($i = 1; $i <= 12; $i++) {
                    echo '<option';
                    if ($i == $_POST['date_m1']) echo ' selected="selected" ';
                    echo ' value=' . $i . '>' . $month[$i] . '</option>';
                }?></select>
                <select name="date_y1">
                    <?php for ($i = 2012; $i <= date("Y"); $i++) {
                    echo '<option';
                    if ($i == $_POST['date_y1']) echo ' selected="selected" ';
                    echo ' value=' . $i . '>' . $i . '</option>';
                }?></select></td>
            <td><input type="submit" value="Поиск"/></td>
        </tr>
    </table>
</form>
<table cellpadding="10" cellspacing="1" border="0" bgcolor="#dcdfe1" width="700" align="center" style="margin-top:10px;">
    <tr bgcolor="#971d81" style="color:#fff; font-weight: bold;">
        <td align="center" width="100">Дата</td>
        <td align="center">Где была покупка</td>
        <td align="center">Сумма покупки</td>
        <td align="center">Сэкономлено</td>
        <td align="center">Деньги</td>
    </tr><?php
        if (strlen($_POST['date_m']) == 1 && $_POST['date_m']) $_POST['date_m'] = '0' . $_POST['date_m'];
        if (strlen($_POST['date_d']) == 1 && $_POST['date_d']) $_POST['date_d'] = '0' . $_POST['date_d'];
        if (strlen($_POST['date_m1']) == 1 && $_POST['date_m1']) $_POST['date_m1'] = '0' . $_POST['date_m1'];
        if (strlen($_POST['date_d1']) == 1 && $_POST['date_d1']) $_POST['date_d1'] = '0' . $_POST['date_d1'];
        $ch_date = " AND date_buy BETWEEN '" . $_POST['date_y'] . "-" . $_POST['date_m'] . "-" . $_POST['date_d'] . "' AND '" . $_POST['date_y1'] . "-" . $_POST['date_m1'] . "-" . $_POST['date_d1'] . "'";
        $sql = "SELECT * FROM member_history WHERE id_user='" . $_SESSION['id_user'] . "' " . $ch_date;
        $res = mysql_query($sql,$db) or die(mysql_error());
        $num_of_row = mysql_num_rows($res);
        if (!is_numeric($_GET['numberpage']) || 0 >= $_GET['numberpage'] || $_GET['numberpage'] > ceil($num_of_row / LIMIT_PAGE_HISTORY)) $numberpage = 1;
        else $numberpage = $_GET['numberpage'];
        $sql = "SELECT * FROM member_history WHERE id_user = '" . $_SESSION['id_user'] . "' " . $ch_date . " ORDER BY date_buy DESC LIMIT " . ($numberpage - 1) * LIMIT_PAGE_HISTORY . "," . LIMIT_PAGE_HISTORY;
        $res = mysql_query($sql, $db) or die(mysql_error());
        while ($row = mysql_fetch_row($res)) {
            ?>
            <tr bgcolor="#fff" style="color:#666666;">
                <td align="center"><? echo date("d.m.Y", strtotime($row[4])); ?></td>
                <td><b><? echo $row[3];?></b></td>
                <td align="center"><? echo $row[5] . ' грн.';?></td>
                <td align="center"><? echo $row[6] . ' грн.';?></td>
                <td align="center"><? echo $row[8]; ?></td>
                        </tr>
            <?
        }
    ?>
</table>
<div style="height:35px;">
    <?php
    echo_page_number($num_of_row, LIMIT_PAGE_HISTORY, './' . $url_page . '/cabinet/' . $_GET['cabinet']);
    ?>
</div>
