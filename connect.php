<?php
//	$server_name='localhost';
//	$server_account='freebcom_freeb';
//	$server_password='4Ge,otvz5O(J';
//	$sql_base='freebcom_free-b';
if( $_SERVER['HTTP_HOST'] === 'fbo.lc' ){
    $server_name     = 'localhost';
    $server_account  = 'root';
    $server_password = 'mysql';
    $sql_base        = 'free-b';
}
else {
    $server_name     = 'freeb00.mysql.ukraine.com.ua';
    $server_account  = 'freeb00_fbo';
    $server_password = '3wqxzqjt';
    $sql_base        = 'freeb00_fbo';
}
