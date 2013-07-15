<?php

require_once( '../config.php' );

if( isset( $_POST['operation_xml '])){
    require_once( dirname( __FILE__  ) . DIRECTORY_SEPARATOR . 'classes/LiqPayMerchant.php' );

    $lpMerchant = new LiqPayMerchant;
    $response = $lpMerchant->parseResponseString( $_POST['operation_xml'] );

    if( $response->status === 'success' ){
        $sql = "UPDATE `member` SET `status`  = `new` WHERE id = " . (int) substr( 0, 5, $response->order_id );
        mysql_query( $sql ) or die ( error_log( 'ORDER_ID = ' .$response->order_id . "\n" . mysql_error() ) );
    }

    error_log( var_export( $response, 1 ) );
}
elseif( !empty( $_GET['operation'] ) ){
    switch( $_GET['operation'] ){
        case 'key_exists': {
            $sql = "SELECT `code` FROM `member` WHERE `code` = '" . mysql_real_escape_string( $_GET['code'] ) . "'";

            $result = mysql_query( $sql ) or die( mysql_error() . ' LINE ' . __LINE__  );

            if( mysql_num_rows( $result ) ){
                header( $_SERVER["SERVER_PROTOCOL"] . " 200 OK" ); exit;
            }
            else
                header( $_SERVER["SERVER_PROTOCOL"] . " 404 Not Found" ); exit;

            break;
        }
        case 'order': {
            $company_id = (int) $_GET['company_id'];
            $amount     = (float) $_GET['amount'];
            $code       = $_GET['code'];

            $sql = "SELECT id FROM `member` WHERE `code` = '" . mysql_real_escape_string( $code ) . "'";
            $result = mysql_query( $sql ) or die( mysql_error() . ' LINE ' . __LINE__  );
            $data = mysql_fetch_assoc( $result );

            $member_id = $data['id'];

            $sql = "SELECT discount FROM `vender` WHERE id = " . (int) $company_id;
            $result = mysql_query( $sql ) or die( mysql_error() . ' LINE ' . __LINE__  );
            $data = mysql_fetch_assoc( $result );
            $discount = $data['discount'];

            $sql = "INSERT INTO `orders_new` VALUES(NULL, '$company_id', $amount, '" . mysql_real_escape_string( $code ) . "', '$member_id', NOW(), $discount)";
            mysql_query( $sql ) or die( mysql_error() . ' LINE ' . __LINE__ );

            require_once( '../file/common.php' );

            $codeGenerator = new CodeGenerator( $member_id );
            $codeGenerator->run()->save();

            break;
        }
    }
}
else
    header( $_SERVER["SERVER_PROTOCOL"] . " 404 Not Found" );


