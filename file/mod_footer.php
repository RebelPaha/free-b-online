<div style="margin-top:10px;margin-left:51px;">

    <div style="float:left; width:133px;">

        <div style="background:url(/image/logo_footer.png) no-repeat; width:133px; height:111px;"></div>

        <div style="margin-top:10px; text-align:center;font-size:11px; color:#fff;">© 2013 freebonline.com</div>

    </div>

    <div style="float:left; width:950px; margin-left:35px; margin-top:15px;">

        <div style="float:left"><?

            $result = mysql_query( "SELECT * FROM page WHERE menu='1'", $db );

            while( $row = mysql_fetch_row( $result ) ){
                ?>

                <a href="/page/<? echo $row[ 0 ]; ?>" class="list_footer" <? if( $row[ 0 ] == $_GET[ 'page' ] )
                    echo 'style="color:#fff"';?>><?  echo $row[ 1 ]; ?></a><br>

            <?

            }

            ?>

        </div>

        <div style="float:left; margin-left:25px;">
            <div style="color:#FFF; font-weight:bold;">РљРђРўРђР›РћР“ РўРћР’РђР РћР’</div>
            <div>

                <?

                $sql = "SELECT id, category_name FROM categories WHERE active_p>0 ORDER BY category_name ASC";

                $res = mysql_query( $sql, $db ) or die( 'РЅРµС‚ СЃРІСЏР·Рё СЃ Р‘Р”' );

                $ccc = 0;

                echo '<div style="float:left;margin-right:10px;">';

                while( $row = mysql_fetch_row( $res ) ){
                    if( $ccc == 14 ){
                        echo '</div><div style="float:left;margin-right:10px;">';
                        $ccc = 0;

                    }
                    echo '<a class="footer_list_pv" href="/page/' . NUMBER_PAGE_PRODUCT . '/category/' . $row[ 0 ] . '">' . $row[ 1 ] . '</a><br>';
                    $ccc += 1;

                }

                echo '</div><div style="clear:both"></div>';

                ?></div>
			<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t12.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet-->

        </div>

        <div style="float:left; margin-left:25px;">
            <div style="color:#FFF; font-weight:bold;">РњРђР“РђР—Р</div>