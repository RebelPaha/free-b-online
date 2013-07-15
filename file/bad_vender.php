<?php
/**
 * Created by Godod.
 * Date: 26.11.12
 * Time: 12:28
 */
?>
    <div class="vender_main"><a class="vender_main_a" href="<? echo $url_page; ?>">Все магазины</a></div><?php
    $sql = "SELECT * FROM vender WHERE active='1' AND category='18'";
    $res = mysql_query($sql, $db) or die();
    $num_of_row = mysql_num_rows($res);
    if (!is_numeric($_GET['numberpage']) || 0 >= $_GET['numberpage'] || $_GET['numberpage'] > ceil($num_of_row / LIMIT_PAGE_VENDER)) $numberpage = 1;
    else $numberpage = $_GET['numberpage'];
    $sql1 = "SELECT id, name, discount, logo, adress, phones, category FROM vender WHERE active='1' AND category='18' ORDER BY logo_pos ASC LIMIT " . ($numberpage - 1) * LIMIT_PAGE_VENDER . "," . LIMIT_PAGE_VENDER;
    $res1 = mysql_query($sql1, $db) or die('нет связи с БД');
    while ($row1 = mysql_fetch_row($res1)) {
        ?>
    <div style="margin-left:1px;">
        <div class="vender_ladn" style="display: block;">
                <div class="vender_ladn_logo"><img src="<? echo DIR_LOGO_PARTNER . '/' . $row1[3]; ?>" width="350"
                                                   height="60"></div>
                <div class="vender_ladn_adress">
                    <div class="vender_ladn_adress_header" style="width: 550px;"><? echo $row1[1];?></div>
                    <?php
                    $txtt = $row1[4];
                    if (strpos($txtt, '<br>')) $txtt = substr($row1[4], 0, strpos($txtt, '<br>'));
                    if (strpos($txtt, 'Херсон')) $txtt = substr($txtt, strpos($txtt, 'Херсон') + 12);
                    if ($txtt) echo $txtt . '<br>'; ?>
                    <? echo $row1[5];?>
                </div>
            <div style="clear:left"></div>
        </div>
    </div>
    <?php
    }
?>