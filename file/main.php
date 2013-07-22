<div class="feed">
    <div class="vender_main">Единая дисконтная система free-B</div>
    <?php
    $sql = "SELECT * FROM `banners_main` ORDER BY pos ASC";
    $result = mysql_query( $sql ) or die( mysql_error() . ' line ' . __LINE__ );

    while( $data = mysql_fetch_assoc( $result ) ):
    ?>
    <div class="feed-item">
        <a href="<?php echo $data['link']; ?>">
            <img src="/img/vendors/<?php echo $data['file']; ?>" alt="<?php echo $data['name']; ?>" />
        </a>

        <div class="feed-item-footer">
            <a class="feed-item-name" href="<?php echo $data['link']; ?>"><?php echo $data['name']; ?></a>
            <div class="feed-item-descr"><?php echo $data['teaser']; ?></div>
            <div class="feed-item-discount">-<?php echo $data['discount']; ?>%</div>
        </div>
    </div>
    <?php endwhile; ?>

    <div style="clear: both;"></div>
</div>