<?php
include_once('../config.php');
/**
 * Created by Godod.
 * Date: 04.12.12
 * Time: 15:31
 */
$sql = "SELECT `name`, `adress`, `phones` FROM vender WHERE active='1'";
$query = mysql_query($sql,$db) or die(mysql_error);
$newfile = fopen('../vender.csv','w+') or die('error');
while($fetch = mysql_fetch_assoc($query)) {
    $string = $fetch['name'].';'.$fetch['adress'].';'.$fetch['phones'].';'."\n";
    $string = iconv('UTF-8','WINDOWS-1251',"$string");
    fwrite($newfile,$string);
}
fclose($newfile);
echo 'Запись сделана';