<?php include( 'config.php' ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>    <!--<base href="http://www.free-b.com.ua">-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/CSS/ms.css" rel="stylesheet" type="text/css" media="screen">
    <!-- Fancybox -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery.animate-colors-min.js"></script>
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css"
          media="screen"/>
    <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.2" type="text/css" media="screen"/>
    <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.2"></script>
    <title><? echo stripslashes( $TITLE );?></title>
    <meta name="description" content="<? echo $DESCRIPTION; ?>">
    <meta name="Keywords"
          content="<? echo $KEYWORD; ?>">    <?php    $t = '<script type="text/javascript" src="js/jquery.js"></script><script type="text/javascript" src="http://userapi.com/js/api/openapi.js?52"></script><script type="text/javascript">  VK.init({apiId: 3058144, onlyWidgets: true});</script>';    //echo $t;    ?>
    <script type="text/javascript" src="/js/jquery.carouFredSel-5.6.1.js"></script>
    <script type="text/javascript" language="javascript">        $(document).ready(function () {
            $("#scrolling_logo").carouFredSel({                prev: '#prev', next: '#next', width: 440, align: false, height: 50, items: {                    visible: 1, minimum: 3, width: 147, height: 34                }, scroll: {                    duration: 600, pauseOnHover: true                }            });
            $("#partner_scroll").carouFredSel({                prev: '#prev1', next: '#next1', width: 117, height: 1950, // 150px 1 блок                direction:"up",                align:false,                items:{                    visible:1,                    minimum:1,                    width:117,                    height:150                },                scroll:{                    duration:1000,                    pauseOnHover:true                }            });        });    </script>
    <script type="text/javascript">        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-33605347-1']);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();    </script>
    <script type="text/javascript">var cssFix = function () {
            var u = navigator.userAgent.toLowerCase(), addClass = function (el, val) {
                if (!el.className) {
                    el.className = val;
                } else {
                    var newCl = el.className;
                    newCl += (" " + val);
                    el.className = newCl;
                }
            }, is = function (t) {
                return (u.indexOf(t) != -1)
            };
            addClass(document.getElementsByTagName('html')[0], [    (!(/opera|webtv/i.test(u)) && /msie (\d)/.test(u)) ? ('ie ie' + RegExp.$1) : is('firefox/2') ? 'gecko ff2' : is('firefox/3') ? 'gecko ff3' : is('gecko/') ? 'gecko' : is('opera/9') ? 'opera opera9' : /opera (\d)/.test(u) ? 'opera opera' + RegExp.$1 : is('konqueror') ? 'konqueror' : is('applewebkit/') ? 'webkit safari' : is('mozilla/') ? 'gecko' : '', (is('x11') || is('linux')) ? ' linux' : is('mac') ? ' mac' : is('win') ? ' win' : ''  ].join(" "));
        }();</script>
</head>
<body>

<? //include(DIR_MAIN_FILE.'\mod_enter.php');
//include('file/hitua.php');
if( is_numeric( $_GET[ 'page' ] ) )
    $url_page = '/page/' . $_GET[ 'page' ];
//	 if($_GET['page']==NUMBER_PAGE_VENDER) $url_page_for_menu='/page/'.NUMBER_PAGE_VENDER;
//	 else { $url_page_for_menu='/page/'.NUMBER_PAGE_PRODUCT;}
$url_page_for_menu = '/page/' . NUMBER_PAGE_VENDER;
if( is_numeric( $_GET[ 'category' ] ) )
    $url_cat = $url_page . '/category/' . $_GET[ 'category' ];

//include(DIR_MAIN_FILE.'\mod_enter.php');
//include('file/hitua.php');if (is_numeric($_GET['page'])) $url_page = '/page/' . $_GET['page'];

//if($_GET['page']==NUMBER_PAGE_VENDER) $url_page_for_menu='/page/'.NUMBER_PAGE_VENDER;
//else { $url_page_for_menu='/page/'.NUMBER_PAGE_PRODUCT;}$url_page_for_menu = '/page/' . NUMBER_PAGE_VENDER;if (is_numeric($_GET['category'])) $url_cat = $url_page . '/category/' . $_GET['category'];?>
<div id="middle_bg"></div>
<div id="top">
    <div id="middle">
        <div id="left_top">
            <div id="menu"><? include( DIR_MAIN_FILE . '/' . 'mod_menu.php' );            if( $_GET[ 'exit' ] == 1 ){
                    unset( $_SESSION[ 'number_card' ], $_SESSION[ 'user_name' ], $_SESSION[ 'phone' ], $_SESSION[ 'birthday' ], $_SESSION[ 'email' ], $_SESSION[ 'balls' ], $_SESSION[ 'change_balls' ], $_SESSION[ 'saved_money' ], $_SESSION[ 'country' ], $_SESSION[ 'city' ] );
                    unset( $_SESSION[ 'id_user' ] );
                    $_SESSION[ 'trash' ] = array();
                    echo '<script language="javascript">	top.location.href="/";	</script>';
                }            ?>
                <div style="clear:both"></div>
            </div>
            <div id="phones">            <?  if( !empty( $_SESSION[ 'id_user' ] ) ){ ?>
                    <div class="phones">
                        <div style="margin-top:15px; margin-left:15px; color:#fff;"><a
                                href="/page/<? echo NUMBER_PAGE_PCABINET; ?>" class="icon1"></a> Баланс: <a
                                class="pc_link"
                                href="/page/<? echo NUMBER_PAGE_PCABINET; ?>"><? echo $_SESSION[ 'balance' ];?>грн.</a>
                            / <a class="pc_link"
                                 href="/page/<? echo NUMBER_PAGE_PCABINET; ?>"><? echo $_SESSION[ 'balls' ];?>fB</a>

                            <div style="clear:left"></div>
                            <div style="clear:left"></div>
                        </div>
                        <div style="margin-top:10px; margin-left:15px; color:#fff;"><a
                                href="/page/<? echo NUMBER_PAGE_PCABINET; ?>" class="icon2"></a> В корзине: <a
                                href="/page/<? echo PAGE_OF_BUY; ?>"
                                class="pc_link"><? echo $_SESSION[ 'count_product' ];?>товара(ов)</a>

                            <div style="clear:left"></div>
                            <div style="width:250px; color:#fff; margin-top:5px; margin-left:5px; float:left;">
                                <div><a class="pc_link" href="/page/<? echo NUMBER_PAGE_PCABINET; ?>">Личный кабинет</a>
                                    <a class="pc_exit" href="/exit/1"><img src="/image/pc_exit.png"> Выход</a></div>
                            </div>
                        </div>
                    </div>            <?
                }
                else{
                    ?>
                    <div
                        class="phones">                <? include( DIR_MAIN_FILE . '/' . 'mod_enter.php' );?>            </div>            <? }?>
            </div>
            <div style="clear:both;"></div>
            <div id="left_top_logo"></div>
            <div id="freeb"><a href="/" border="0"><img src="/image/logo.png" alt="logo"
                                                        title="Единая дисконтная система free-B."></a></div>
            <div id="freeb1">
                <div class="freeb_header">Скидки<br/>до 90%</div>
                <div class="freeb_header2">на все виды товаров, каждый день новые предложения</div>
            </div>
            <div id="freeb2">
                <div style="float:left; margin-top:24px; width:268px; height:1px;"><a
                        href="/page/<? echo NUMBER_PAGE_HOWCERTIFICATION; ?>" class="freeb_howcertification"></a></div>
                <div style="float:left; margin-top:20px; width:268px;"><a href="/page/<? echo NUMBER_PAGE_HOWORDER; ?>"
                                                                          class="freeb_howorder"></a></div>
                <div
                    style="float:right; margin-top:50px; width:261px;"><? include( DIR_MAIN_FILE . '/' . '/mod_search.php' ); ?></div>
                <div style="clear:both"></div>
                <div
                    style="width:509px; background:url(<? echo DIR_MAIN_IMAGES; ?>/top.png); margin-left:20px; height:50px;">
                    <div style="width:509px; padding-top:8px; height:50px;">
                        <style>                        #scrolling_logo a:hover {
                                border: #006 1px solid;
                            }

                            #scrolling_logo a {
                                border-left: #971d81 1px solid;
                            }

                            a.prev, a.next {
                                background: url(/image/prev.png) no-repeat;
                                width: 28px;
                                height: 28px;
                                display: block;
                                margin: 4px 3px 0px 3px;
                            }

                            a.prev:hover {
                                background-position: 0 -30px;
                            }

                            a.next:hover {
                                background-position: -30px -30px;
                            }

                            a.next {
                                background-position: -30px 0px;
                            }                    </style>
                        <!-- Карусель вендеров сверху-справа -->
                        <div style="float:left;"><a id="prev" class="prev" href="#"></a></div>
                        <div id="scrolling_logo" align="center"
                             style="float:left;">                        <?                        $result = mysql_query( "SELECT id, category, top_logo FROM vender WHERE top_logo_pos>0 AND top_logo!='' AND active!=0 ORDER BY top_logo_pos ASC", $db );                        while( $row = mysql_fetch_row( $result ) ){ ?>
                                <a href='/page/<? echo NUMBER_PAGE_VENDER; ?>/category/<? echo $row[ 1 ]; ?>/partner/<? echo $row[ 0 ]; ?>'
                                   style="float:left"><img src='<? echo DIR_LOGO_ROLLING . '/' . $row[ 2 ]; ?>'
                                                           border="0" width="145"
                                                           height="34"></a>                            <? }                        ?>
                        </div>
                        <div style="float:left;"><a id="next" class="next" href="#"></a></div>
                        <!-- /Карусель вендеров сверху-справа -->
                        <div style="clear:left;"></div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div id="right_top"><? include( DIR_MAIN_FILE . '/' . 'mod_stock.php' ); ?></div>
        <div style="clear:both;"></div>
    </div>
    <div id="main">
        <div id="left_colum">
            <div class="left_menu">
                <div class="left_menu_top"></div>
                <div class="left_menu_bg">
                    <div class="left_menu_mid"><? include( DIR_MAIN_FILE . '/' . 'mod_leftmenu.php' ); ?></div>
                </div>
                <div class="left_menu_bot"></div>
            </div>        <?php        $t = '<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?52"></script><!-- VK Widget --><div id="vk_groups" class="left_menu1"></div><script type="text/javascript">VK.Widgets.Group("vk_groups", {mode: 0, width: "200", height: "360"}, 51987365);</script>';        echo $t;        ?>
            <div class="left_menu1">
                <div class="left_menu1_top"></div>
                <div class="left_menu1_mid">
                    <div class="left_menu1_tophead">Лучшее предложение
                    </div>                <? include( DIR_MAIN_FILE . '/' . '/mod_leftmenu1.php' ); ?>            </div>
                <div class="left_menu1_bot"></div>
            </div>
            <div class="left_menu2">
                <div class="left_menu2_top"></div>
                <div class="left_menu2_mid">
                    <div
                        style="padding:15px;"><?                    $result = mysql_query( "SELECT description FROM page WHERE id='" . PAGE_ABOUT . "'", $db );                    if( $row = mysql_fetch_row( $result ) ){
                            echo $row[ 0 ];
                        }                    ?>                </div>
                </div>
                <div class="left_menu2_bot"></div>
            </div>
        </div>
        <div id="middle_colum">
            <div class="l_ch"></div>
            <div class="m_ch"><? include( DIR_MAIN_FILE . '/' . 'mod_topmenu.php' ); ?></div>
            <div class="r_ch"></div>
            <div style="clear:both"></div>
            <table cellpadding="0" cellspacing="0" border="0" width="741" style="margin-top:11px;">
                <tr>
                    <td height="6"><img src="<? echo DIR_MAIN_IMAGES; ?>/content_top.png"/></td>
                </tr>
                <tr valign="top">
                    <td class="content_mid">
                        <? if( $_GET[ 'page' ] > 0 && !empty( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ){
                            $result = mysql_query( "SELECT description, file, header FROM page WHERE id='" . $_GET[ 'page' ] . "'", $db );
                            $row    = mysql_fetch_row( $result );
                            if( $row ){
                                $TXT_DESCRIPTION = $row[ 0 ];
                                if( strpos( $row[ 1 ], 'ile=' ) )
                                    include( DIR_MAIN_FILE . '/' . substr( $row[ 1 ], 5 ) );
                                else{
                                    echo '<div class="vender_main">' . $row[ 2 ] . '</div>		 <div style="margin:15px 25px; color:#666">' . $TXT_DESCRIPTION . '</div>';
                                }
                            }
                            else{
                                $_SESSION[ 'changed' ] = 1;
                                echo '<script language="javascript">	top.location.href="/page/' . CHANGED_PAGE . '";	</script>';
                            }
                        }
                        else{
                            $_SESSION[ 'changed' ] = 1;
                            echo '<script language="javascript">	top.location.href="/page/' . CHANGED_PAGE . '";	</script>';
                        }
                        //print_r($_SERVER);            if (!$_GET['page_num']) {                ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="content_bot"></td>
                </tr>                <?php            //}            ?>        </table>
        </div>
        <div id="right_colum">
            <div class="partner_top"></div>
            <div class="partner_mid">
                <div style="margin:0 4px 0 3px;">
                    <div class="partner_header">Наши<br/>партнеры
                    </div>                <? include( DIR_MAIN_FILE . '/' . 'mod_partner.php' ); ?>            </div>
            </div>
            <div class="partner_bot"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="footer_text_bg">
        <div id="footer">
            <div id="footer_top"></div>
            <div id="footer_text"><? include( DIR_MAIN_FILE . '/' . 'mod_footer.php' );?></div>
        </div>
    </div>
</div>
</body>
</html>