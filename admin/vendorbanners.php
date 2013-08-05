<?php
if ($_SERVER['REMOTE_ADDR'] == '93.79.190.177') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
if( $_SESSION[ 'lvl' ] != 0 ) {
    exit( 'Недостаточно прав доступа' );
}

$imgPath = '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR;
$action  = isset( $_GET['action'] ) ? $_GET['action'] : null;

if( isset($_GET['id']) ){
    $sql = "SELECT * FROM `banners_main` WHERE id = " . (int) $_GET['id'];
    $result = mysql_query( $sql ) or die( mysql_error());
    $data = mysql_fetch_assoc( $result );
}
else {
    $data = array(
        'id' => '',
        'pos' => '0',
        'discount' => '',
        'name' => '',
        'file' => '',
        'teaser' => '',
        'link' => '',
        'descr' => ''
    );
}

if( ($_GET['action'] === 'add') || ($_GET['action'] === 'edit') ){

?>
    <a href="?p=12">Назад к списку баннеров</a><br><br>
    <form action="?p=12<?php if( !empty( $data['id'] ) ) echo '&id=' . $data['id']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><?php if( !empty($data['id']) ) echo 'Правка баннера № ' . $data['id']; else echo 'Добавить новый баннер'; ?></legend>
            <table cellpadding="0" cellspacing="6" border="0" width="100%">
                <tr>
                    <td valign="top" width="150">Название бренда</td>
                    <td valign="top" align="left">
                        <input type="text" name="brand" size="70" value="<?php echo $data['name']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td valign="top" width="150">Изображение</td>
                    <td valign="top" align="left">
                        <input type="file" name="img" /><br>
                        <?php if( $data['file'] ): ?>
                        <br>
                        <img src="../img/vendors/<?php echo $data['file']; ?>" alt="" /><br>
                        <strong>Если выберете новый файл, то после сохроанения данное изображение перезапиштеся</strong>
                        <?php endif; ?>
                        <ul>
                            <li>Баннер на всю ширину - 840x310px;</li>
                            <li>Баннер в половину ширины - 410х310px;</li>
                            <li>Добступные расширения: jpg, jpeg, png, gif.</li>
                        </ul>
                    </td>
                </tr>

                <tr>
                    <td valign="top" width="150">Скидка, %</td>
                    <td valign="top" align="left">
                        <input type="text" name="discount" size="3" maxlength="3" value="<?php echo $data['discount']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td valign="top" width="150">Ссылка</td>
                    <td valign="top" align="left">
                        <input type="text" name="link" size="50" value="<?php echo $data['link']; ?>" />
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
                    <td valign="top" width="150"></td>
                    <td valign="top" align="left">
                        <input type="submit" value="Сохранить" name="save" />&nbsp;
                        <a href="?=p=12">Отмена</a>
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
                $filePath = $data['file'];
                unlink( $imgPath . $filePath );
            }
            else {
                $filePath = md5( $_FILES['img']['name'] . time() ) . '.' . $fileExt;
            }

            move_uploaded_file( $_FILES['img']['tmp_name'], $imgPath . $filePath );
        }
        else {
            $filePath = $data['file'];
        }

        if( isset($_GET['id']) ){
            $sql = "UPDATE `banners_main` SET
                name = '" . mysql_real_escape_string($_POST['brand']) . "',
                file = '" . basename( $filePath ) . "',
                teaser = '" . mysql_real_escape_string($_POST['teaser']) . "',
                descr = '" . mysql_real_escape_string($_POST['descr']) . "',
                discount = '" . $_POST['discount'] . "',
                link = '" . $_POST['link'] . "',
                pos = '" . $_POST['pos'] . "'
            WHERE id = " . $_GET['id'];

            mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

            $msg = 'Баннер успешно изменен';
        }
        else {
            $sql = "INSERT INTO `banners_main` VALUES(
            null,
            '" . mysql_real_escape_string($_POST['brand']) . "',
            '" . basename( $filePath ) . "',
            '" . mysql_real_escape_string($_POST['teaser']) . "',
            '" . mysql_real_escape_string($_POST['descr']) . "',
            '" . $_POST['discount'] . "',
            '" . $_POST['pos'] . "',
            '" . $_POST['link'] . "'
        )";

            mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

            $msg = 'Баннер успешно добавлен';
        }

    }
    elseif( $action === 'delete' ) {
        unlink( $imgPath . $data['file'] );

        $sql = "DELETE FROM `banners_main` WHERE id = " . $data['id'];

        mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

        $msg = 'Баннер успешно удален';
    }

    if( !empty( $msg )){
        echo '<div style="color: green;"'.  $msg . '</div>';
    }

    $sql = "SELECT * FROM `banners_main` ORDER BY pos ASC";
    $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

    echo '<a href="?p=12&action=add">Добавить</a><br><div class="feed">';

    while( $data = mysql_fetch_assoc( $result ) ){
       echo '<div class="feed-item">
       <div class="controls">
        <a href="?p=12&action=edit&id=' . $data['id'] . '">Изменить</a>&nbsp;
        <a href="?p=12&action=delete&id=' . $data['id'] . '"  onclick="return confirm(\'Действительно хотит эту удалить эту запись?\');">Удалить</a>
       </div>
        <a href="?p=12&action=edit&id=' . $data['id'] . '"><img src="../img/vendors/' . $data['file'] . '" /></a>

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