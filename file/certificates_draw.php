<div class="feed">
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sql = "SELECT * FROM `certificates_draw` WHERE `id` = {$_GET['id']} LIMIT 1";

        $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );
        if (mysql_num_rows($result) > 0) {
            $data = mysql_fetch_assoc( $result );
            /*if ($_SERVER['REMOTE_ADDR'] == '46.118.18.36') {
                var_dump($data['active'] === 0);
            }*/

            $imgs = array();
            if (!empty($data['add_files']))
                $imgs = explode(',', $data['add_files']);
    ?>

    <div class="vender_main"><?php echo ($data['active'] == 0) ? '[ЗАВЕРШЁН] ' : ''; ?><?php echo $data['name']; ?></div>

    <div class="cert-item">
        <div class="cert-item-images">
            <img src="/img/certificates/<?php echo $data['file']; ?>" alt="<?php echo $data['name']; ?>" />
            <ul class="previews">
                <?php foreach ($imgs as $img): ?>
                    <li><a class="cert-gallery" data-lightbox="add-images" href="/img/certificates/<?php echo $img; ?>"><img src="/img/certificates/preview/<?php echo $img; ?>" alt=""/></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="cert-item-description">
            <div class="feed-item-name"><?php echo $data['name']; ?></div>
            <div class="feed-item-descr"><?php echo $data['descr']; ?></div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div style="clear: both;"></div>
    <?php
        }
    } else {
    $active = isset($_GET['ended']) ? 0 : 1;
    $title = isset($_GET['ended']) ? 'Прошедшие розыгрыши' : 'Розыгрыши сертификатов';
    $sql = "SELECT * FROM `certificates_draw` WHERE `active` = {$active} ORDER BY pos ASC";
    $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

    echo '<div class="vender_main">' . $title . '</div>';
        if (mysql_num_rows($result) > 0) {
    while( $data = mysql_fetch_assoc( $result ) ):
    ?>
    <div class="feed-item">
        <a href="/brands/<?php echo $data['id']; ?>">
            <img src="/img/certificates/<?php echo $data['file']; ?>" alt="<?php echo $data['name']; ?>" />
        </a>

        <div class="feed-item-footer">
            <a class="feed-item-name" href="/brands/<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a>
            <div class="feed-item-descr"><?php echo $data['teaser']; ?></div>
        </div>
    </div>
    <?php endwhile;
    } else { ?>
    <div class="message">На данный момент нет активных розыгрышей</div>
    <?php }
    }
    ?>

    <div style="clear: both;"></div>
</div>