<?php
/**
 * Created by Godod.
 * Date: 28.02.13
 * Time: 10:58
 */
$sql = "SELECT `id`, `description`, `url_vendera`, `img` FROM `stock` WHERE `active`='1'";
$mysql = mysql_query($sql, $db) or die('Нет Акций');
$f = 1;
$f_line = 0;
while ($row = mysql_fetch_assoc($mysql)) {
    ?>
<div class="content_echo_product" <? if ($f_line > 1) echo 'style="border-top:#dee5e9 1px solid"'; elseif ($f_line > 2) $f_line = 2; else $f_line += 1;?>>
    <? if ($row['description']) { ?>
    <div style="position:absolute; z-index:1;"><img src="/image/action.png"
                                                    alt="Акция на товар: <? echo $row['description'];?>"/></div><? } ?>
    <div class="content_product_inside">
        <a class="product_inside_header" href="#" alt="Акция на товар: <? echo $row['description'];?>">
            <img src="<? echo DIR_MAIN_IMAGES;?>/<? echo $row['img']; ?>" width="160" height="124"
                 align="left" style="margin-right:15px;" border="0"/>
        </a>

        <div style="float:left;width:150px; height: 80px"><a class="product_inside_header" href="#"
                                                             title="<? echo $row['description'];?>">
            <? echo $row['description']?></a></div>

        <div style="clear:left;"></div>
        <div class="product_inside_detail"><a class="detail_btn_a"
                                              href="<?php echo $row['url_vendera']; ?>"
                                              alt="Подробное описание: <? echo $row[2];?>"></a></div>
    </div>
    <div style="clear:left"></div>
</div>
<?
    if ($f) {
        echo '<div class="content_echo_divide"></div>';
        $f = 0;
    } else $f = 1;
    echo '<div style="clear: left;"></div>';
} ?>