<style>
    .left_menu1_conteiner:hover {
        background: #e3e7ea;
    }
</style>

<?

$result = mysql_query( "SELECT id, category, name, price, our_price, image, expiration_date FROM product WHERE active='1' ORDER BY purchased DESC LIMIT 2", $db );

while( $row = mysql_fetch_row( $result ) ){
    ?>
    <div class="left_menu1_conteiner" onclick="window.location='/page/<? echo NUMBER_PAGE_PRODUCT; ?>/category/<? echo $row[ 1 ]; ?>/product/<? echo $row[ 0 ] ?>'" style="cursor:pointer;">

        <div class="left_menu1_header"><? echo $row[ 2 ];?></div>

        <div class="left_menu1_logo">
            <img src="<? echo DIR_PRODUCT_IMAGE; ?>/sm_<? echo $row[ 5 ]; ?>" width="160" height="124" border="0" />
        </div>
        <div class="left_menu1_discount">
            <div class="left_menu1_discount_1"><? echo  floor( ( 1 - $row[ 4 ] / $row[ 3 ] ) * 100 );?></div>
            <div class="left_menu1_discount_2"></div>
            <div class="left_menu1_discount_3"><? echo $row[ 4 ];?> грн.
                <div class="left_menu1_discount_4"><? echo $row[ 3 ];?> грн.</div>
            </div>
            <div style="clear:left"></div>
        </div>
        <div class="left_menu1_btn">
            <a href="/page/<? echo NUMBER_PAGE_PRODUCT; ?>/category/<? echo $row[ 1 ]; ?>/product/<? echo $row[ 0 ] ?>"
               class="detail_btn_a"></a>
        </div>
		

    </div>
<?

}

?>