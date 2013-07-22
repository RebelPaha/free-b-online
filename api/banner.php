<?php
$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';

switch( $_GET['v'] ){
    case '1':
        $file = '0NVhmBsSAHg.jpg';
        break;
    case '2':
        $file = 'logo_hands.jpg';
        break;
    default:
        $file = 'logo_hands.jpg';

}
?>
<a href="javascript:parent.location.href='<?php echo $host;?>'">
    <img src="<?php echo $host; ?>/img/vendors/<?php echo $file; ?>"
        <?php if( $_GET['width'] ) echo ' width="' . (int) $_GET['width'] . '"'; ?>
        alt="free-B Online - Единая Система Скидок" />
</a>