<div class="feed">
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sql = "SELECT * FROM `certificates_draw` WHERE `id` = {$_GET['id']} AND `active` = 1 LIMIT 1";

        $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );
        if (mysql_num_rows($result) > 0) {
        $data = mysql_fetch_assoc( $result )
    ?>

    <div class="vender_main">Сертификат "<?php echo $data['name']; ?>"</div>

    <div class="feed-item">
        <img src="/img/certificates/<?php echo $data['file']; ?>" alt="<?php echo $data['name']; ?>" />

        <div class="feed-item-footer">
            <a class="feed-item-name" href="<?php //echo $data['link']; ?>"><?php echo $data['name']; ?></a>
            <div class="feed-item-descr"><?php echo $data['teaser']; ?></div>
            <div class="feed-item-discount">-<?php echo $data['discount']; ?>%</div>
        </div>
    </div>

    <div style="clear: both;"></div>
    <?php
        }
    } else { ?>
        <div class="vender_main">Розыгрыш сертификатов</div>
    <?php
    $active = isset($_GET['ended']) ? 0 : 1;
    $sql = "SELECT * FROM `certificates_draw` WHERE `active` = {$active} ORDER BY pos ASC";
    $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

    while( $data = mysql_fetch_assoc( $result ) ):
    ?>
    <div class="feed-item">
        <a href="/brands/<?php echo $data['id']; ?>">
            <img src="/img/certificates/<?php echo $data['file']; ?>" alt="<?php echo $data['name']; ?>" />
        </a>

        <div class="feed-item-footer">
            <a class="feed-item-name" href="/brands/<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a>
            <div class="feed-item-descr"><?php echo $data['teaser']; ?></div>
            <div class="feed-item-discount">-<?php echo $data['discount']; ?>%</div>
        </div>
    </div>
    <?php endwhile;
    }
    ?>

    <div style="clear: both;"></div>
</div>