<?php

require_once( '../config.php' );

ini_set('display_errors', 1);
error_reporting( E_ALL );

    if( $_GET[ 'action' ] === 'mail' ){
    $v1 = array(
        'from'    => 'pavel.kolomiets@freebonline.com',
        'subject' => 'MAIL TEST',
        'text'    => '<!DOCTYPE html>
<html>
<head>
    <title>Коммерческое предожение</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <style>
        div, p, span, strong, b, em, i, a, li, td {
            -webkit-text-size-adjust: none;
        }
    </style>
</head>
<body>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                <!--header line statrs-->
                <tr>
                    <td style="margin: 0; padding: 0; line-height: 15px; border-bottom: 1px solid #000000; width:180px; height:165px;">
                        <img src="http://freebonline.com/img/mail/logo.jpg" width="180" height="165" style="display: block;" alt="" />
                    </td>
                    <td style="margin: 0; padding: 0 20px 0 0; border-bottom: 1px solid #000000; height:165px;" align="right">
                        <div>ООО «ФРИ-БИ»</div>
                        <a href="http://freebonline.com" target="_blank" title="Написать нам письмо" style="color: #000000 !important; text-decoration: underline;">
                            <span style="color: #000000;">www.freebonline.com</span>
                        </a>
                    </td>
                    <td style="margin: 0; padding: 0; width: 30%; height:165px; border-bottom: 1px solid #000000;" align="right">
                        <div style="border-left: 1px solid #000000;">
                            <div>Виталий Мазур</div>
                            <div>+38 (099) 5521561</div>
                            <!--<div>Сергей Мельниченко</div>-->
                            <!--<div>+38 (050) 593 79 31 </div>-->
                            <!--<div>+38 (098) 392 82 26</div>-->

                            <!--<div>Владимир Козел-Богуцкий</div>-->
                            <!--<div>+38 (096) 564 40 33</div>-->
                            <!--<div>+38 (050) 318 54 33</div>-->
                            <div>Владимир Микитко</div>
                            <div>+38 (099) 059 34 70</div>
                            <div>+38 (095) 765 92 82</div>
                            <a href="mailto:info@freebonline.com" target="_blank" title="Написать нам письмо" style="color: #000000 !important; text-decoration: underline;">
                                <span style="color: #000000;">info@freebonline.com</span>
                            </a>
                        </div>
                    </td>
                </tr>
                <!--header line end-->
                <!--content statrs-->
                <tr>
                    <td style="margin: 0; padding: 0;" colspan="3" align="center">
                        <table width="540" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                            <tr>
                                <td border="0" align="left">
                                    <h3 style="text-align: center; color: #b22985;">Добрый день!</h3>
                                    <p style="font-size:16px; padding: 0; text-indent: 30px;">Предлагаем Вам привлечение большой аудитории новых клиентов. На сегодняшний день мы можем обеспечивать более <b>120 000</b> просмотров вашей рекламы через наш сайт и через соц. сети в месяц (аудитория более <b>65 000</b> человек) От Вас требуется только удобная для Вас  скидка (скидка может быть разной: бонусной, накопительной, постоянной, дифференцированной, в виде подарков, сертификатов как вам будет удобно) на Ваши товары или услуги.</p>

                                    <h4 style="text-align: center; color: #b22985;">Что вы получите от  участия в системе &laquo;free-B Online&raquo; (услуги предоставляются целый год)</h4>
                                    <ul style="text-align: left;">
                                        <li>реклама на сайте www.freebonline.com  с личной страничкой плюс размещение в топах сайта;</li>
                                        <li>реклама в соц. группах. всех акций, предложений и т.д.:  ВКонтакте, Одноклассники, Facebook. Количество наших подписчиков больше 65 000 человек;</li>
                                        <li>реклама на сайте и в соц. сетях (аудитория 65 000 человек) путем подарочных сертификатов (Вы можете предоставить какую то хорошую скидку или подарок на ваши товары или услуги чтобы заинтересовать потребителей или мы вам от себя подарим на 400 грн. подарочных сертификатов(часы, пополнение счета, техника и многое другое)) с помощью них мы сделаем розыгрыши по группам общей аудиторией 65 000 человек цель которого просмотры вашей рекламы и привлечение новых клиентов к вам(это будет сделано для того чтобы вы ощутили эффективность работы с нами). Реклама в социальных сетях, в настоящее время набирает большие обороты. И в связи с этим появилась инновационная система розыгрышей. Почему это эффективно? Потому что об акции узнают не только подписавшиеся участники, но и все их друзья (более двух миллионов просмотров вашей рекламы) Помимо этого, Ваш товар или услуга «висит» на сайте не только пока длится акция, но и после ее окончания в разделе «прошедшие акции»;</li>
                                        <li>разработка эффективного маркетингового инструмента для привлечения новых клиентов и удержание существующих клиентов.</li>
                                        <li>подробнее можно ознакомиться в прикрепленном файле free-B_Presentation.pdf</li>
                                    </ul>

                                    <div style="color: #ffffff; background: #df0019; padding: 20px; text-align: center; font-size: 20px;"><b>Акционное предложение!</b> до конца августа 2013 года те, кто  подключаться к нам участие в нашей программе обойдется всего <b style="text-decoration: underline;"><span style="font-size: 30px;">200</span> грн. в год.</b></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!--content end-->
            </table>
            <!--footer img starts-->
            <table width="660" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                <tr>
                    <td align="left"><br><b>С удажением, директор ООО &laquo;ФРИ-БИ&raquo; Владимир Микитко.</b></td>
                </tr>
            </table>
            <!--footer img end-->
        </td>
    </tr>
</table>
</body>
</html>'
    );
    include_once( 'classes/phpMailer/class.phpmailer.php' );
    include_once( 'classes/freebMailer.php' );
    $mailer = new freebMailer( array(
                                    'smtp_mode'     => 'enabled',
                                    'smtp_host'     => 'mail.ukraine.com.ua',
                                    'smtp_port'     => '25',
                                    'smtp_username' => 'info@freebonline.com',
                                    'smtp_password' => 'XgA19ki2',
                                    'from_email'    => 'info@freebonline.com',
                                    'from_name'     => 'Media Group "free-B"',
                                    'From'          => $v1[ 'from' ]
                               ) );
    $mailer->Subject = $v1[ 'subject' ];
    $mailer->Body    = $v1[ 'text' ];

//    $sql = "SELECT email FROM Vendor WHERE email != '' AND send != 'v1'";//" ORDER BY id DESC LIMIT 1";
//    $result = mysql_query( $sql ) or die( mysql_error() . ' line: ' . __LINE__ );

//    while( $data = mysql_fetch_assoc( $result ) ) {
//        echo $data['email'] . '<br>';
//        $mailer->AddAddress( $data['email'], '' );
//
//        if( !$mailer->Send() ){
//            echo '';
//        }
//        else{
//            echo 'Письмо отослано!<br>';
//
//            $sql = "UPDATE `Vendor` SET send = 'v1' WHERE email = '" . $data['email'] . "'";
//            mysql_query( $sql ) or die( mysql_error() . ' line: ' . __LINE__ );
//        }
//        $mailer->ClearAddresses();
//        $mailer->ClearAttachments();
//    }

    // Добавляем адрес в список получателей
//    $mailer->AddAddress( 'kolomiets.p@gmail.com', 'Pavel GG' );
//    $mailer->AddAddress( 'vladimirmikitko@gmail.com', 'Pavel GG' );
//    $mailer->AddAddress( 'freepopov@ukr.net', 'Alexey' );
//    $mailer->AddAddress( 'melnichenkoukr@gmail.com', 'Sergey' );
//    $mailer->AddAddress( '13kbwf@gmail.com', 'Sergey' );
    $mailer->AddAddress( 'lil.viy.inc@gmail.com', 'Sergey' );

    if( !$mailer->Send() ){
        echo 'Не отправлено.';
    }
    else{
        echo 'Письмо отослано!<br>';
    }
}



