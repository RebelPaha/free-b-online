<style>
    .stock_btn {
        background: url(/image/btn_stock1.png) no-repeat;
        width: 60px;
        height: 61px;
        display: block;
    }

    a.stock_btn:hover {
        background-position: 0 -61px;
    }
</style>
<!--<div class="stock_header_mod"><a class="stock_header_mod" href="/page/--><?// echo NUMBER_PAGE_STOCK;?><!--">РОЗЫГРЫШИ<br>И ПРИЗЫ</a></div>-->
<? //
//	$result=mysql_query("SELECT id, name_action, image FROM action WHERE status='1' ORDER BY event_date DESC LIMIT 1",$db);
//	if($row=mysql_fetch_row($result))
//	{
//
?>
<!--<div style="margin-top:20px;" align="center"><a href="/page/--><?// echo NUMBER_PAGE_STOCK;?><!--/action/--><?// echo $row[0];?><!--" style=" color:#3e1344; text-decoration:none;">-->
<?// echo $row[1];?><!--</a></div>-->
<!--<div style="margin-top:10px;" align="center">-->
<!--<a href="/page/--><?// echo NUMBER_PAGE_STOCK;?><!--/action/--><?// echo $row[0];?><!--">-->
<!--<img src="--><?// echo DIR_STOCK_IMAGE.'/sm_'.$row[2]; ?><!--" width="100" border="0" height="73"></a></div>-->
<!--<div style="position:absolute; top:154px; z-index:1; margin-left:31px;"><a href="/page/--><?// echo NUMBER_PAGE_STOCK;?><!--/action/--><?// echo $row[0];?><!--" class="stock_btn">&nbsp;</a></div>-->
<? //
//	}
//
?>
<?php
if(isset($_POST['selectCity'])) {
     $_SESSION['city'] = $_POST['city'];
$url = '/';
	echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
//    $query = "SELECT `name` FROM `city` WHERE `id`='".$_POST['city']."' LIMIT 1";
//    $mysql = mysql_query($query,$db);
//    $city = mysql_fetch_assoc($mysql);
//    ?>
<!--    <div class="stock_header_mod">ВАШ<br>ГОРОД</div>-->
<!--    <div style="margin-top:20px; font-size: 14px;" align="center">--><?php //echo $city['name']; ?><!-- </div>-->
<?php }
?>
<div class="stock_header_mod">ВАШ<br>ГОРОД</div>
<form method="post">
    <div style="margin-top:20px;" align="center">
        <select name="city">
            <?php
            $result = mysql_query("SELECT `id`, `name` FROM `city`", $db);
            while ($row = mysql_fetch_row($result)) {
		if($_SESSION['city'] == $row[0]) {
			$selected = 'selected';
		} else {
			$selected = '';
		}
                ?>
                <option <?php echo $selected ?> value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                <?php
            }
            ?>
    </div>
    </select>
    <div style="margin-top:10px;" align="center">
        <input type="submit" name="selectCity" value="Ok">
    </div>
</form>
</div>
<!--        --><?php //} ?>