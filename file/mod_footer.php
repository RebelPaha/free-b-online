<div style="margin-top:10px;margin-left:51px;">    <div style="float:left; width:133px;">        <div style="background:url(/image/logo_footer.png) no-repeat; width:133px; height:111px;"></div>        <div style="margin-top:10px; text-align:center;font-size:11px; color:#fff;">&copy; 2013 freebonline.com</div>    </div>    <div style="float:left; width:950px; margin-left:35px; margin-top:15px;">        <div style="float:left"><?            $result = mysql_query( "SELECT * FROM page WHERE menu='1'", $db );            while( $row = mysql_fetch_row( $result ) ){                ?>                <a href="/page/<? echo $row[ 0 ]; ?>" class="list_footer" <? if( $row[ 0 ] == $_GET[ 'page' ] )                    echo 'style="color:#fff"';?>><?  echo $row[ 1 ]; ?></a><br>            <?            }            ?>        </div>        <div style="float:left; margin-left:25px;">            <div style="color:#FFF; font-weight:bold;">КАТАЛОГ ТОВАРОВ</div>            <div>                <?                $sql = "SELECT id, category_name FROM categories WHERE active_p>0 ORDER BY category_name ASC";                $res = mysql_query( $sql, $db ) or die( 'нет связи с БД' );                $ccc = 0;                echo '<div style="float:left;margin-right:10px;">';                while( $row = mysql_fetch_row( $res ) ){                    if( $ccc == 14 ){                        echo '</div><div style="float:left;margin-right:10px;">';                        $ccc = 0;                    }                    echo '<a class="footer_list_pv" href="/page/' . NUMBER_PAGE_PRODUCT . '/category/' . $row[ 0 ] . '">' . $row[ 1 ] . '</a><br>';                    $ccc += 1;                }                echo '</div><div style="clear:both"></div>';                ?></div>        </div>        <div style="float:left; margin-left:25px;">            <div style="color:#FFF; font-weight:bold;">МАГАЗИНЫ</div>            <div>                <?                $sql = "SELECT id, category_name FROM categories WHERE active_v>0 ORDER BY category_name ASC";                $res = mysql_query( $sql, $db ) or die( 'нет связи с БД' );                $ccc = 0;                echo '<div style="float:left;margin-right:10px;">';                while( $row = mysql_fetch_row( $res ) ){                    if( $ccc == 7  ){                        echo '</div><div style="float:left;margin-right:10px;">';                        $ccc = 0;                    }                    echo '<a class="footer_list_pv" href="/page/' . NUMBER_PAGE_VENDER . '/category/' . $row[ 0 ] . '">' . $row[ 1 ] . '</a><br>';                    $ccc += 1;                }                echo '</div><div style="clear:both"></div>';                ?></div>        </div>        <div style="clear:left"></div>    </div>    <div style="clear:left"></div>    <div style="color:#FFF; margin-top:25px; font-style:italic;">Теги:        freebee <a href="" class="list_footer" style="text-transform:none; font-style: normal">freebee</a>,        free-b <a href="" class="list_footer" style="text-transform:none; font-style: normal">free-b</a>,        freebe <a href="" class="list_footer" style="text-transform:none; font-style: normal">freebe</a>,        fribi <a href="" class="list_footer" style="text-transform:none; font-style: normal">fribi</a>,        frebe <a href="" class="list_footer" style="text-transform:none; font-style: normal">frebe</a>,        freeb <a href="" class="list_footer" style="text-transform:none; font-style: normal">freeb</a>,        фриби <a href="" class="list_footer" style="text-transform:none; font-style: normal">фриби</a>,        freb <a href="" class="list_footer" style="text-transform:none; font-style: normal">freb</a></div>    <?php include( 'hitua.php' ) ?></div>