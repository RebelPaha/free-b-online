<?php

//var_dump( $_SERVER[ 'HTTP_HOST' ] );exit;

if( $_SERVER['HTTP_HOST'] === 'fbo.lc'){
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