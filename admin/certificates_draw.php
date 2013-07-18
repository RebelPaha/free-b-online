<?php

if( $_SESSION[ 'lvl' ] != 0 ) {
    exit( 'Недостаточно прав доступа' );
}

$imgPath = '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR;
$action  = isset( $_GET['action'] ) ? $_GET['action'] : null;
$imgs = array();

if( isset($_GET['id']) ){
    $sql = "SELECT * FROM `certificates_draw` WHERE id = " . (int) $_GET['id'];
    $result = mysql_query( $sql ) or die( mysql_error());
    $data = mysql_fetch_assoc( $result );
    if (!empty($data['add_files']))
        $imgs = explode(',', $data['add_files']);
}
else {
    $data = array(
        'id' => '',
        'pos' => '0',
        'discount' => '',
        'name' => '',
        'file' => '',
        'teaser' => '',
        'descr' => '',
        'active' => '0'
    );

}

if( ($_GET['action'] === 'add') || ($_GET['action'] === 'edit') ){
var_dump($data['file']);
var_dump($imgs);
?>
    <a href="?p=13">Назад к списку сертификатов</a><br><br>
    <form action="?p=13<?php if( !empty( $data['id'] ) ) echo '&id=' . $data['id']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><?php if( !empty($data['id']) ) echo 'Правка сертификата № ' . $data['id']; else echo 'Добавить новый сертификат'; ?></legend>
            <table cellpadding="0" cellspacing="6" border="0" width="100%">
                <tr>
                    <td valign="top" width="150">Название</td>
                    <td valign="top" align="left">
                        <input type="text" name="brand" size="70" value="<?php echo $data['name']; ?>" />
                    </td>
                </tr>

                <tr class="image-form">
                    <td valign="top" width="150">Изображение</td>
                    <td valign="top" align="left">
                        <input class="upload" type="file" name="img" /><br>
                        <?php if( $data['file'] ): ?>
                        <br>
                        <img src="../img/certificates/<?php echo $data['file']; ?>" alt="" /><br>
                        <strong>Если выберете новый файл, то после сохранения данное изображение перезапишеnся</strong>
                        <?php endif; ?>
                        <ul>
                            <li>Баннер на всю ширину - 840x310px;</li>
                            <li>Баннер в половину ширины - 410х310px;</li>
                            <li>Доступные расширения: jpg, jpeg, png, gif.</li>
                        </ul>
                    </td>
                </tr>
                <?php if (count($imgs) > 0): ?>
                <?php foreach ($imgs as $k => $img): ?>
                    <tr>
                        <td valign="top" width="150">Изображение</td>
                        <td valign="top" align="left">
                            <input class="upload" type="file" name="img<?php echo $k + 1; ?>" /><br>
                            <strong>Если выберете новый файл, то после сохранения данное изображение перезапишеnся</strong>
                            <?php if( $img ): ?>
                                <br>
                                <img src="../img/certificates/<?php echo $img; ?>" alt="" /><br>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td></td>
                    <td><a href="#" onclick="var elem = $('input.upload:last').clone().attr('name','img' + $('input.upload').length); elem.insertAfter($(this)); return false;">Добавить дополнительное изображение<br></a></td>
                </tr>
                <tr>
                    <td valign="top" width="150">Скидка, %</td>
                    <td valign="top" align="left">
                        <input type="text" name="discount" size="3" maxlength="3" value="<?php echo $data['discount']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td valign="top" width="150">Позиция в списке</td>
                    <td valign="top" align="left">
                        <input type="text" name="pos" size="10" maxlength="3" value="<?php echo $data['pos']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td valign="top" width="150">Краткое описание</td>
                    <td valign="top" align="left">
                        <input type="text" name="teaser" size="70" value="<?php echo $data['teaser']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="150">Подробное описание</td>
                    <td valign="top" align="left">
                        <textarea name="descr" rows="10" cols="70"><?php echo $data['descr']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="150">Розыгрыш активен?</td>
                    <td valign="top" align="left">
                        <select name="active">
                            <option selected value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="150"></td>
                    <td valign="top" align="left">
                        <input type="submit" value="Сохранить" name="save" />&nbsp;
                        <a href="?=p=13">Отмена</a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
<?php
}
else{
    if( isset( $_POST['save'] ) ){
        if( is_uploaded_file($_FILES['img']['tmp_name']) ) {
            $fileExt = pathinfo( $_FILES['img']['name'], PATHINFO_EXTENSION );

            if( !empty( $data['file'] ) ){
                $img = $data['file'];
                unlink( $imgPath . $img );
            }
            else {
                $img = md5( $_FILES['img']['name'] . time() ) . '.' . $fileExt;
            }

            move_uploaded_file( $_FILES['img']['tmp_name'], $imgPath . $img );
        }
        else {
            $img = $data['file'];
        }

        $i = 0;
        $filePath = array();
        array_shift($_FILES);

        foreach ($_FILES as $file) {
            if( is_uploaded_file($file['tmp_name']) ) {
                $fileExt = pathinfo( $file['name'], PATHINFO_EXTENSION );

                if( !empty( $imgs[$i] ) ){
                    $filePath[$i] = $imgs[$i];
                    unlink( $imgPath . $imgs[$i] );
                }
                else {
                    $filePath[$i] = md5( $file['name'] . time() ) . '.' . $fileExt;
                }

                move_uploaded_file( $file['tmp_name'], $imgPath . $filePath[$i]  );
            }
            else {
                $filePath[] = $imgs[$i];
            }
            $i++;
        }

        $add_imgs = count($filePath) > 0 ? $add_imgs = join(',', $filePath) : '';

        if( isset($_GET['id']) ){
            $sql = "UPDATE `certificates_draw` SET
                name = '" . $_POST['brand'] . "',
                file = '" . basename( $img ) . "',
                add_files = '" . $add_imgs . "',
                teaser = '" . $_POST['teaser'] . "',
                descr = '" . $_POST['descr'] . "',
                discount = '" . $_POST['discount'] . "',
                pos = '" . $_POST['pos'] . "',
                active = '" . $_POST['active'] . "'
            WHERE id = " . $_GET['id'];

            mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

            $msg = 'Сертификат успешно изменен';
        }
        else {
            $sql = "INSERT INTO `certificates_draw` VALUES(
            null,
            '" . $_POST['brand'] . "',
            '" . basename( $img ) . "',
            '" . $add_imgs . "',
            '" . $_POST['teaser'] . "',
            '" . $_POST['descr'] . "',
            '" . $_POST['discount'] . "',
            '" . $_POST['pos'] . "',
            '" . $_POST['active'] . "'
        )";

            mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

            $msg = 'Сертификат успешно добавлен';
        }

    }
    elseif( $action === 'delete' ) {
        unlink( $imgPath . $data['file'] );

        $sql = "DELETE FROM `certificates_draw` WHERE id = " . $data['id'];

        mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

        $msg = 'Сертификат успешно удален';
    }

    if( !empty( $msg )){
        echo '<div style="color: green;"'.  $msg . '</div>';
    }

    $sql = "SELECT * FROM `certificates_draw` ORDER BY pos ASC";
    $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

    echo '<a href="?p=13&action=add">Добавить</a><br><div class="feed">';

    while( $data = mysql_fetch_assoc( $result ) ){
       echo '<div class="feed-item">
       <div class="controls">
        <a href="?p=13&action=edit&id=' . $data['id'] . '">Изменить</a>&nbsp;
        <a href="?p=13&action=delete&id=' . $data['id'] . '"  onclick="return confirm(\'Действительно хотит эту удалить эту запись?\');">Удалить</a>
       </div>
        <a href="?p=13&action=edit&id=' . $data['id'] . '"><img src="../img/certificates/' . $data['file'] . '" /></a>

        <div class="feed-item-footer">
            <a class="feed-item-name" href="$">' . $data['name'] . '</a>
            <div class="feed-item-descr">' . $data['teaser'] . '</div>
            <div class="feed-item-discount">-' . $data['discount'] . '%</div>
        </div>
    </div>';
    }

    echo '</div>';
}
?>
<style type="text/css">
    .feed img {
        margin: 0;
    }

    .feed a {
        display: block;
    }

    .feed .feed-item {
        /*outline: 1px solid red;*/
        float: left;
        position: relative;
        margin: 20px 0 0 20px;
        padding: 0;
    }

    .feed .feed-item-footer {
        /*background-color: rgba(151, 27, 129, 0.506);*/
        background-color: rgba(255, 255,255, 0.606);
        /*outline: 1px solid yellow;*/
        position: absolute;
        width: 100%;
        height: 86px;
        bottom: 0;
    }

    .feed .feed-item-name {
        display: block;
        color: #971b81;
        font-size: 14pt;
        margin: 10px 0 0 10px;
    }

    .feed .feed-item-descr {
        color: #971b81;
        font-size: 10pt;
        margin: 10px 0 0 10px;
    }

    .feed .feed-item-discount {
        position: absolute;
        top: 19px;
        right: 10px;
        color: #971b81;
        font-size: 33pt;
    }

    .feed-item .controls {
        position: absolute;
        top: 0;
        right: 0;
        background-color: rgba(255, 255,255, 0.606);
        padding: 5px;
    }

    .feed-item .controls a {
        display: block;
        float: left;
        margin-left: 10px;
    }
</style>