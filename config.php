<?phpsession_save_path( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'tmp' );session_start();ini_set( 'display_errors', 1 );error_reporting( E_ALL ^ E_NOTICE );if( isset( $_SESSION[ 'city' ] ) && $_SESSION[ 'city' ] == null ){    $_SESSION[ 'city' ] = 1;}include( 'connect.php' );$month = array( 1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября',                'Ноября', 'Декабря');function lastnumber( $a ){    $b = $a / 10;    $c = ceil( $b );    if( $b - $c == 0 )        return 0;    elseif( $b < 1 )        return ceil( $b * 10 );    elseif( $b > 1 )        return ceil( $b - $c ) * 10;}include_once( 'file/common.php' );// Пути к папкамdefine( 'DIR_MAIN_IMAGES', '/image' );define( 'DIR_LOGO_PARTNER', '/img/partner' );define( 'DIR_LOGO_OURPARTNER', '/img/ourpartner' );define( 'DIR_LOGO_ROLLING', '/img/rolling' );define( 'DIR_PRODUCT_IMAGE', '/img/product' );define( 'DIR_STOCK_IMAGE', '/img/stock' );define( 'DIR_MAIN_FILE', 'file' );define( 'DIR_UPLOAD_CHECK', '/upload' );define( 'PAGE_OF_BUY', '9' );define( 'NUMBER_PAGE_VENDER', '27' );define( 'NUMBER_PAGE_PRODUCT', '3' );define( 'NUMBER_PAGE_HOWORDER', '6' );define( 'NUMBER_PAGE_HOWCERTIFICATION', '28' );define( 'NUMBER_PAGE_STOCK', '8' );define( 'NUMBER_PAGE_HISTOCK', '10' );define( 'NUMBER_PAGE_REG2', '18' );define( 'CHANGED_PAGE', '21' );define( 'PAGE_REGISTRATION', '18' );define( 'NUMBER_PAGE_PCABINET', '11' );define( 'PAGE_ABOUT', '17' );define( 'NUM_MENU_STOCK', '3' );define( 'NUM_MENU_SHOP', '6' );//	Ограничение кол-ва страниц и инициация переменной страницif( !isset( $_GET[ 'numberpage' ] ) )    $_GET[ 'numberpage' ] = 1;define( 'LIMIT_PAGE_STOCK', '20' );define( 'LIMIT_PAGE_HISTORYSTOCK', '20' );define( 'LIMIT_PAGE_VENDER', '15' );define( 'LIMIT_PAGE_VENDER', '10' );define( 'LIMIT_PAGE_PRODUCT', '18' );define( 'LIMIT_PAGE_HISTORY', '25' );define( 'LIMIT_PAGE_MAIL', '26' );//define( 'TEMPLATE_PRODUCT', '<div><div style="float:left; width:365px; margin-right:10px;">	<b style="font-size:16px; color:#971d81;">Условия</b><ul style="margin:5px 0px 0px 20px; padding:0px;">  <li>Быть зарегистрированным клиентом и держателем дисконтной карточки free-B. <a href="/page/6" class="vender_name_p">Как получить карточку?</a></li>  <li>Иметь на счету необходимое количество fB  (1fB=1грн). <a href="/page/6" class="vender_name_p">Как собирать fB баллы и как они начисляются?</a>.</li>  <li>Нажать кнопку купить</li>  <li>В течении некоторого времени вам придёт уведомление об обработанном заказе в личный кабинет и на электронную почту.</li>  <li>Прийти к нашему партнеру, указанному в поле "Место проведения" и  показать свою дисконтную карточку.</li>  <li>Забираете товар или пользуетесь услугой, улыбаетесь и продолжаете пользоваться единой дисконтной системой free-B</li>  <li>В случае возникновения сложностей Вы можете <a href="/page/2" class="vender_name_p">обратиться к нам написав письмо</a>.</li></ul></div><div style="float:right; width:300px; background-color:#E4DFD5;">{map}</div>	<div style="clear:both;"></div><div style="border-top:#cdcdcd 1px solid; margin:10px 0;"></div></div>' );function echo_page_number( $num_of_colum, $limit, $url ){    if( $num_of_colum > $limit ){        ?>        <div style="float:left; background: url(image/page_left.png) no-repeat; width: 8px; height:36px;"></div>        <div style="float:left; background: url(image/page_bg.png); width: 726px; height:36px;">            <div                style="margin-top:5px; margin-left:<? echo 267 - ( ( ceil( $num_of_colum / $limit ) - 2 ) * 16.5 ); ?>px"                align="center">                <a style="float:left;background:url(image/page_back2.png) no-repeat; height:26px; width: 28px; margin-right:5px; display:block;"                   href="<? echo $url; ?>/numberpage/1"></a>                <a style="float:left;background:url(image/page_back.png) no-repeat; height:26px; width: 28px; margin-right:5px;display:block;"                   href="<? echo $url; ?>/numberpage/<? if( $_GET[ 'numberpage' ] > 1 )                       echo ( $_GET[ 'numberpage' ] - 1 );                   else echo '1'; ?>"></a>                <?                if( $_GET[ 'numberpage' ] > 6 )                    $numberone = $_GET[ 'numberpage' ] - 5;                else $numberone = 1;                for( $i = 1; $i <= 6; $i++ ){                    if( $_GET[ 'numberpage' ] == $numberone )                        echo '<div style="float:left;background:url(image/page_btn.png) no-repeat; height:26px; width: 28px; margin-right:5px; line-height:26px;"><b>' . $numberone . '</b></div>';                    else{                        ?>                        <a class="page_number"                           href="<? echo $url; ?>/numberpage/<? echo $numberone; ?>"><? echo $numberone;?></a>                    <?                    }                    $numberone++;                    if( $i == ceil( $num_of_colum / $limit ) )                        break;                }                ?>                <a style="float:left;background:url(image/page_next.png) no-repeat; height:26px; width: 28px; margin-right:5px;display:block;"                   href="<? echo $url; ?>/numberpage/<? if( $_GET[ 'numberpage' ] < ceil( $num_of_colum / $limit ) )                       echo ( $_GET[ 'numberpage' ] + 1 );                   else echo ceil( $num_of_colum / $limit ); ?>"></a>                <a style="float:left;background:url(image/page_next2.png) no-repeat; height:26px; width: 28px;display:block;"                   href="<? echo $url; ?>/numberpage/<? echo ceil( $num_of_colum / $limit ); ?>"></a>                <div style="clear:left"></div>            </div>        </div>        <div style="float:right; background: url(image/page_right.png) no-repeat; width: 7px; height:36px;"></div>        <div style="clear:both;"></div>        </td>        </tr>        <tr>            <td valign="top" align="center" height="7"><img src="/image/page_shadow.png"/></td>        </tr>        <?        $_GET[ 'page_num' ] = 1;    }}// Функция задания времени, для обратного отсчетаfunction set_time( $timeup ){    ?>    <script language="javascript">        var timerID;        var timerRunning = false;        var today = new Date();        var count = new Date();        var secPerDay = 0;        var minPerDay = 0;        var hourPerDay = 0;        var secsLeft = 0;        var            secsRound = 0;        var secsRemain = 0;        var minLeft = 0;        var minRound = 0;        var dayRemain = 0;        var minRemain = 0;        var Expire = 0;        var timeRemain = 0;        var timeUp = "";        function stopclock() {            if (timerRunning) clearTimeout(timerID);            timerRunning = false;        }        function startclock() {            stopclock();            showtime();        }        function showtime() {            today = new Date();            count = new Date("<? echo $timeup; ?>");   // december 31, 2011 23:59:59  enter date to count down to (use the same format) count.setYear(today.getYear()); secsPerDay = 1000 ;            minPerDay = 60 * 1000;            hoursPerDay = 60 * 60 * 1000;            PerDay = 24 * 60 * 60 * 1000;            Expire = (count.getTime() - today.getTime())            /*Seconds*/            secsLeft = (count.getTime() - today.getTime()) / minPerDay;            secsRound = Math.round(secsLeft);            secsRemain = secsLeft - secsRound;            secsRemain = (secsRemain < 0) ? secsRemain = 60 - ((secsRound - secsLeft) * 60) : secsRemain = (secsLeft - secsRound) * 60;            secsRemain = Math.round(secsRemain);            /*Minutes*/            minLeft = ((count.getTime() - today.getTime()) / hoursPerDay);            minRound = Math.round(minLeft);            minRemain = minLeft - minRound;            minRemain = (minRemain < 0) ? minRemain = 60 - ((minRound - minLeft) * 60) : minRemain = ((minLeft - minRound) * 60);            minRemain = Math.round(minRemain - 0.495);            /*Hours*/            hoursLeft = ((count.getTime() - today.getTime()) / PerDay);            hoursRound = Math.round(hoursLeft);            hoursRemain = hoursLeft - hoursRound;            hoursRemain = (hoursRemain < 0) ? hoursRemain = 24 - ((hoursRound - hoursLeft) * 24) : hoursRemain = ((hoursLeft - hoursRound) * 24);            hoursRemain = Math.round(hoursRemain - 0.5);            /*Days*/            daysLeft = ((count.getTime() - today.getTime()) / PerDay);            daysLeft = (daysLeft);            daysRound = Math.round(daysLeft);            daysRemain = daysRound;            /*Fixes*/            if (daysRemain == 1) daysRemain = daysRemain + " день, ";            else daysRemain = daysRemain + " дней, ";            if (hoursRemain <= 9) hoursRemain = hoursRemain + ":"; else hoursRemain = hoursRemain + ":";            if (minRemain <= 9) minRemain = "0" + minRemain + ":"; else minRemain = minRemain + ":";            if (secsRemain <= 9) secsRemain = "0" + secsRemain; else secsRemain = secsRemain;            /*Time*/            timeRemain = daysRemain + hoursRemain + minRemain + secsRemain;            window.status = "";            document.clock.face.value = timeRemain;            timerID = setTimeout("showtime()", 1000);            timerRunning = true;            if (Expire <= 0) {                document.clock.face.value = 0;  // choose either "time" or "timeUp"  (without quotes) stopclock()            }        } // De-activate Cloaking -->  // --> </script><?}// Функция подключения к базеfunction connect_to_base( $srv_name, $srv_account, $srv_password, $sql_bd ){    $db = mysql_connect( $srv_name, $srv_account, $srv_password ) or die( 'Не возможно подключиться к базе' );    mysql_query( "set names utf8" );    mysql_select_db( $sql_bd );    return $db;}// Инициализация корзиныif( empty( $_SESSION[ 'trash' ] ) ){    $_SESSION[ 'trash' ]         = array();    $_SESSION[ 'summa' ]         = 0;    $_SESSION[ 'count_product' ] = 0;}date_default_timezone_set( 'Europe/Kiev' );// Подключение к базе$db = connect_to_base( $server_name, $server_account, $server_password, $sql_base ) or die( 'error in config.php' );if( !isset( $_GET[ 'page' ] ) )    $_GET[ 'page' ] = 1;$sql = "SELECT html_title, html_keyword, html_description FROM ";if( $_GET[ 'product' ] && is_numeric( $_GET[ 'product' ] ) )    $sql .= "product WHERE id='" . $_GET[ 'product' ] . "' LIMIT 1";elseif( $_GET[ 'partner' ] && is_numeric( $_GET[ 'partner' ] ) )    $sql .= "vender WHERE id='" . $_GET[ 'partner' ] . "' LIMIT 1";elseif( $_GET[ 'action' ] && is_numeric( $_GET[ 'action' ] ) )    $sql .= "action WHERE id='" . $_GET[ 'action' ] . "' LIMIT 1";elseif( $_GET[ 'page' ] && is_numeric( $_GET[ 'page' ] ) )    $sql .= "page WHERE id='" . $_GET[ 'page' ] . "' LIMIT 1";else $sql .= "page WHERE id='" . CHANGED_PAGE . "' LIMIT 1";$result = mysql_query( $sql, $db ) or die( 'Title ' .mysql_error() );if( $row = mysql_fetch_row( $result ) ){    $TITLE       = $row[ 0 ];    $DESCRIPTION = $row[ 2 ];    $KEYWORD     = $row[ 1 ];}$sql = "SELECT * FROM `member` WHERE login='" . $_POST[ 'login' ] . "' AND password='" . md5( $_POST[ 'upass' ] ) . "' LIMIT 1";$res = mysql_query( $sql, $db ) or die( 'Не могу соединиться с базой' );$data = mysql_fetch_assoc( $res );if( $data['status'] === 'wait_payment'){    header( 'Location: /page/18?status=wait_payment&account_id=' . $data['id'] );    exit;}